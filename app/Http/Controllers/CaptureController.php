<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerExchange;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerExchangeCapture;
use Illuminate\Support\Facades\Storage;

class CaptureController extends Controller
{
     // Tunable: Euclidean distance threshold for "same person"
    private float $MATCH_THRESHOLD = 0.55; // 0.5–0.6 typical for face-api.js
    public function index(){
        return view('includes.facerecognit');
    }

    public function store(Request $request)
    {

        // Expect JSON: { image: 'data:image/png;base64,...', descriptor: [..128 floats..] }
        $request->validate([
            'image' => 'required|string',
            'descriptor' => 'nullable|array',
        ]);
        $selcomid=Session('log_into_company_id');
        // 1) Decode base64 image
        $data = $request->input('image');
        if (!preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            return response()->json(['ok' => false, 'msg' => 'Bad image data URL'], 422);
        }
        $ext = strtolower($type[1]); // jpg, png
        $data = substr($data, strpos($data, ',') + 1);
        $data = base64_decode($data);
        if ($data === false) {
            return response()->json(['ok' => false, 'msg' => 'Base64 decode failed'], 422);
        }

         // 2) Store file in public disk (=> storage/app/public/customers/...)
        //$filename = Str::uuid()->toString() . '.' . $ext;
        $filename =Auth::id() . '_' . now()->format('Ymd_His') . '_' . $selcomid . '.' . $ext;
        $path = 'customers/' . $filename;
        //Storage::disk('public')->put($path, $data);

        $descriptor = $request->input('descriptor'); // null or [floats]

        // 3) Try to match an existing customer (if descriptor provided)
        $matchedCustomer = null;
        if (is_array($descriptor) && count($descriptor) > 0) {
            $matchedCustomer = $this->findClosestCustomer($descriptor);
        }
        $current = Carbon::now()->setTimezone('Asia/Phnom_Penh');
        // $current = Carbon::now();
        // $current->timezone('Asia/Phnom_Penh');
        //$dd = date("Y-m-d",strtotime($current));
        $dd = $current->format('Y-m-d');

        // Get Y-m-d H:i:s (24-hour format)
        $tt = $current->format('Y-m-d H:i:s');
        //dd($dd,$tt);
        $rankseconds=16;
        // 4) If no match, create new customer
        if (!$matchedCustomer) {
            //check if second<1

            $lastrecord=CustomerExchange::where('company_id',$selcomid)->whereDate('created_at',$dd)->orderBy('id','desc')->first();
            if($lastrecord){
                $crt = $lastrecord->created_at??''; // UTC
                $rankseconds = $crt->diffInSeconds($tt, false);
            }
            if($rankseconds>15){
                $matchedCustomer = CustomerExchange::create([
                    'name' => null,
                    'photo' => $path,
                    'user_id' => Auth::id(),
                    'face_embedding' => $descriptor ?? null,
                    'created_at' => $tt,
                    'updated_at' => $tt,
                    'company_id' => $selcomid,
                ]);
            }
        } else {
            // Optional: refresh reference photo and embedding
            // $matchedCustomer->update([
            //     'photo' => $path,
            //     'face_embedding' => $descriptor ?? $matchedCustomer->face_embedding,
            // ]);
        }
        if($matchedCustomer && $rankseconds>15){
            $lastCapture = CustomerExchangeCapture::where('customer_exchange_id', $matchedCustomer->id)->where('company_id',$selcomid)->whereDate('created_at',$dd)->latest('created_at')->first();
            $minutes=0;
            $seconds=0;
            if($lastCapture){
                $lastCaptureTime = $lastCapture->created_at; // UTC
                $minutes = $lastCaptureTime->diffInMinutes($tt, false);
                $seconds = $lastCaptureTime->diffInSeconds($tt, false);
            }
            // Save if no previous capture, OR last capture was more than 15 minutes ago
            if (!$lastCapture || $minutes>=15) {
                CustomerExchangeCapture::create([
                    'customer_exchange_id' => $matchedCustomer->id,
                    'photo' => $path,
                    'user_id' => Auth::id(),
                    'stand_time' => 0,//new record
                    'created_at' => $tt,
                    'updated_at' => $tt,
                    'company_id' => $selcomid,
                ]);
                Storage::disk('public')->put($path, $data);
                 return response()->json([
                    'ok' => true,
                    'customer_id' => $matchedCustomer->id,
                    'photo_url' => asset('storage/'.$path),
                ]);
            }else{
                //$lastCapture->update(['stand_second'=>$seconds]);
                $lastCapture->timestamps = false;//prevent laravel auto change updated_at
                $lastCapture->stand_time = $seconds;
                $lastCapture->updated_at=$tt;
                $lastCapture->save();
                 return response()->json([
                    'ok' => false,
                    'minute' => $minutes,
                    'photo_url' => "not save",
                    'lastcapturetime' => $lastCaptureTime,
                    'seccond' => $seconds,
                    'current' => $tt,
                ]);
            }
        }




    }

    private function findClosestCustomer(array $probe): ?CustomerExchange
    {
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        $dd = date("Y-m-d",strtotime($current));
        $best = null;
        $bestDist = PHP_FLOAT_MAX;
        $selcomid=Session('log_into_company_id');
        CustomerExchange::where('company_id',$selcomid)->whereDate('created_at',$dd)->whereNotNull('face_embedding')->chunk(200, function ($chunk) use (&$best, &$bestDist, $probe) {
            foreach ($chunk as $cust) {
                $dist = $this->euclidean($probe, $cust->face_embedding ?? []);
                if ($dist !== null && $dist < $bestDist) {
                    $bestDist = $dist;
                    $best = $cust;
                }
            }
        });

        if ($best && $bestDist <= $this->MATCH_THRESHOLD) {
            return $best;
        }
        return null;
    }

    private function euclidean(array $a, array $b): ?float
    {
        $n = min(count($a), count($b));
        if ($n === 0) return null;
        $sum = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $d = floatval($a[$i]) - floatval($b[$i]);
            $sum += $d * $d;
        }
        return sqrt($sum);
    }
}
