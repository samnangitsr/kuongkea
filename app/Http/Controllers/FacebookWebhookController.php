<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacebookWebhookController extends Controller
{
    public function success()
    {
        return 'success';
    }
    // GET verification
    public function verify(Request $request)
    {
        $verify_token = config('services.facebook.verify_token');

        $mode = $request->get('hub_mode') ?? $request->get('hub.mode');
        $token = $request->get('hub_verify_token') ?? $request->get('hub.verify_token');
        $challenge = $request->get('hub_challenge') ?? $request->get('hub.challenge');

        if ($mode && $token) {
            if ($mode === 'subscribe' && $token === $verify_token) {
                return response($challenge, 200);
            } else {
                return response('Forbidden', 403);
            }
        }
        return response('OK', 200);
    }

    // POST incoming messages
    public function receive(Request $request)
    {
        Log::info('FB Webhook payload: ' . $request->getContent());

        $data = $request->all();
        if (!empty($data['entry'])) {
            foreach ($data['entry'] as $entry) {
                $messagings = $entry['messaging'] ?? [];
                foreach ($messagings as $messageEvent) {
                    // sender PSID:
                    $psid = $messageEvent['sender']['id'] ?? null;
                    if ($psid) {
                        // Save PSID in DB for later use (example: table fb_psids)
                        DB::table('fb_psids')->updateOrInsert(
                            ['psid' => $psid],
                            ['last_seen' => now()]
                        );
                    }
                    // Optionally handle message text, attachments, etc.
                }
            }
        }
        return response('EVENT_RECEIVED', 200);
    }
}
