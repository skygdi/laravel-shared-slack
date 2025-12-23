<?php

namespace Skygdi\Slack\Services;

use Illuminate\Support\Facades\Http;
use Skygdi\Slack\SlackGate;

class SlackService
{
    public function sendMessage(string $text, ?string $channel = null, array $blocks = null): bool
    {
        // ⛔ Slack suspended? Just stop gracefully.
        if (SlackGate::isSuspended()) {
            return false; // or true if you want “soft success”
        }
        
        //$token   = config('services.slack.bot_token');
        //$channel = $channel ?? config('services.slack.default_channel');

        $token   = config('slack-gate.bot_token');
        dump($token);
        $channel = $channel ?? config('slack-gate.default_channel');

        if (! $token || ! $channel) {
            return false; // or throw exception
        }

        $payload = [
            'channel' => $channel,
            'text'    => $text,
        ];

        if ($blocks) {
            $payload['blocks'] = $blocks;
        }

        $response = Http::withToken($token)
            ->post('https://slack.com/api/chat.postMessage', $payload);

        return $response->successful() && $response->json('ok') === true;
    }
}
