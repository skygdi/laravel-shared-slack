<?php

namespace Pg\Slack;

use Illuminate\Support\Facades\Cache;
use Pg\Slack\Services\SlackService;

class SlackGate
{
    public const CACHE_KEY = 'slack:suspended';

    public static function suspend(?int $minutes = null): void
    {
        if ($minutes === null) {
            Cache::forever(self::CACHE_KEY, true);
            return;
        }

        Cache::put(self::CACHE_KEY, true, now()->addMinutes($minutes));
    }

    public static function resume(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function isSuspended(): bool
    {
        return (bool) Cache::get(self::CACHE_KEY, false);
    }

    public static function info(string $title, ?array $context = null): void
    {
        if (self::isSuspended()) {
            return;
        }

        $message = "*{$title}*";

        if (!empty($context)) {
            $lines = [];
            foreach ($context as $key => $value) {
                $prettyKey = ucfirst(str_replace('_', ' ', (string) $key));
                $lines[] = "`{$prettyKey}:` {$value}";
            }
            $message .= "\n" . implode("\n", $lines);
        }

        app(SlackService::class)->sendMessage($message);
    }
}
