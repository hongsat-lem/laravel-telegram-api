<?php
namespace CamboDev\LaravelTelegramApi;

use Illuminate\Support\Facades\Facade;

class TelegramFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CamboDev\LaravelTelegramApi\Telegram';
    }
}
