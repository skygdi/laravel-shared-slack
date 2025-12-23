<?php

namespace Skygdi\Slack\Providers;

use Illuminate\Support\ServiceProvider;

class SlackGateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/slack-gate.php', 'slack-gate');
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(
            __DIR__.'/../resources/views',
            'slack'
        );

        /*
        $this->publishes([
            __DIR__.'/../config/slack-tools.php' => config_path('slack-tools.php'),
        ], 'config');
        */
    }
}
