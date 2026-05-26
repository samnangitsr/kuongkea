<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\PageTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    public function time(Request $request)
    {
        $userId = Auth::id();
        $current = Carbon::now();
        $current->timezone('Asia/Phnom_Penh');
        if ($request->action === "open") {
            // Record page opened
            $id = DB::table('page_times')->insertGetId([
                'user_id' => $userId,
                'url' => $request->url,
                'name' => $request->action,
                'started_at' => $current,
                'created_at' => $current,
                'updated_at' => $current
            ]);

            // Store ID in session to know which row to update on close
            //session(['page_time_id_' . $request->url => $id]);

        } elseif ($request->action === "close") {
            // Get the ID stored in session
           // $id = session('page_time_id_' . $request->url);
           $pt=PageTime::where('user_id',$userId)->where('name','open')->orderBy('id','DESC')->first();

            if ($pt) {
                DB::table('page_times')->where('id', $pt->id)
                    ->update(['ended_at' => now(),'name' => $request->action]);
            }
            // remove from user_onlines
             DB::table('user_onlines')
                ->where('user_id', $userId)
                ->where('url','like','%' . $request->url)
                ->delete();
        }

        return response()->json(['status' => 'ok']);
    }
     public function offline(Request $request)
    {
        //Log::info('Offline called', $request->all());
        $userId = Auth::id();
        $url=$request->url;
        if($request->tabcount==0){
            DB::table('user_onlines')->where('user_id',$userId)->delete();
            DB::table('user_onlines')->whereNull('user_id')->delete();
        }
        // if ($userId) {
        //     // remove this user's current page entry
        //     DB::table('user_onlines')
        //         ->where('user_id', $userId)
        //         ->where(function($q) use($url){
        //             $q->where('url','like','%' . $url)->orWhere('url',env("APP_URL").'//')->orWhere('url',env("APP_URL").'/login');
        //         })

        //         ->delete();
        // } else {
        //     // for guest (by IP)
        //     DB::table('user_onlines')
        //         ->where('ip_address', $request->ip())
        //         ->where('url', $request->url)
        //         ->delete();
        // }

        return response()->json(['status' => 'ok']);
    }
}
