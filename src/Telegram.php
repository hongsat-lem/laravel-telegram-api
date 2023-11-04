<?php

namespace CamboDev\LaravelTelegramApi;
use CamboDev\LaravelTelegramApi\TelegramUtility;
use Illuminate\Support\Facades\Log;

class Telegram
{
    private $api_key = '';
    private $link = '';

    public function __construct()
    {
        $this->link = env('APP_URL');
        $this->api_key = env('TELEGRAM_API_KEY');
    }

    public function sendReplyComment($text, $chart_id, $api_key)
    {
        $telegram = new TelegramUtility($chart_id, $api_key);
        $message2 = '';
        $message2 .= $text . PHP_EOL;

        $sound = 'normal';

        return $telegram->sendMessage($message2, $sound, $this->link);
    }

    public function sendText($text, $chart_id, $redirect = null)
    {
        $telegram = new TelegramUtility($chart_id, $this->api_key);
        $message2 = '';
        $message2 .= $text . PHP_EOL;

        $sound = 'normal';

        return $telegram->sendMessage($message2, $sound, $redirect);
    }

    public function testConnection($telegram_username)
    {
        $telegram = new TelegramUtility($telegram_username, $this->api_key);
        $message2 = 'Bot connected.' .PHP_EOL;
        $message2 .= 'Group: '. $telegram_username.PHP_EOL;
        $message2 .= 'Status: Connected.'.PHP_EOL;

        $sound = 'normal';

        return $telegram->sendMessage($message2, $sound);
    }

    public function sentMedia($text, $photo, $chart_id, $join = null)
    {
        $telegram = new TelegramUtility($chart_id, $this->api_key);

        $sound = 'normal';
        $type = '';
        $link = $join?'https://t.me/'.$chart_id:'';

        return $telegram->sendPhoto($text, $sound, $photo, $type, $link);
    }

    public function sendMediaGroup($text, $photo, $chart_id)
    {
        $telegram = new TelegramUtility($chart_id, $this->api_key);

        $sound = 'normal';
        $type = '';

        return $telegram->sendMediaGroup($text, $sound, $photo, $type);
    }
}
