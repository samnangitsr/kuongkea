<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $botToken;
    protected $chatId;
    protected $botToken1;
    protected $chatId1;
    protected $botToken2;
    protected $chatId2;
    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->chatId = env('TELEGRAM_CHAT_ID');
        $this->botToken1 = env('TELEGRAM_BOT_TOKEN1');
        $this->chatId1 = env('TELEGRAM_CHAT_ID1');
        $this->botToken2 = env('TELEGRAM_BOT_TOKEN2');
        $this->chatId2 = env('TELEGRAM_CHAT_ID2');
    }

    public function sendMessage_cetificatSSL($message)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        return $response->json();
    }
    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        $url1 = "https://api.telegram.org/bot{$this->botToken1}/sendMessage";
        $url2 = "https://api.telegram.org/bot{$this->botToken2}/sendMessage";

        $responses = [];
        $responses[]= Http::withOptions([
            'verify' => false,  // Disable SSL verification (temporary fix)
        ])->post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        $responses[] = Http::withOptions([
            'verify' => false,  // Disable SSL verification (temporary fix)
        ])->post($url1, [
            'chat_id' => $this->chatId1,
            'text' => $message,
        ]);

        $responses[] = Http::withOptions([
            'verify' => false,  // Disable SSL verification (temporary fix)
        ])->post($url2, [
            'chat_id' => $this->chatId2,
            'text' => $message,
        ]);

        return $responses;
    }

    public function sendMessageMulitChartId($message,array $chatIds)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";

        $responses = [];

        foreach ($chatIds as $chatId) {
            $response = Http::withOptions([
                'verify' => false,  // Disable SSL verification (temporary fix)
            ])->post($url, [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML', // Enables bold and italic formatting
            ]);

            $responses[$chatId] = $response->json();
        }

        return $responses;
    }
}
