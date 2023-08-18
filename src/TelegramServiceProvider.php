<?php

namespace Cambodev\LaravelTelegramApi;

use CamboDev\LaravelTelegramApi\Telegram;
use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton(__DIR__, function ($app) {
            return $app->make(Telegram::class);
        });
    }
}
