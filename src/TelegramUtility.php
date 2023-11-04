<?php


namespace CamboDev\LaravelTelegramApi;


use Illuminate\Support\Facades\Log;

class TelegramUtility
{
    private $curl_obj;
    private $chat_id;
    private $api_key;

    public function __construct($chat_id, $api_key)
    {
        if(!function_exists('curl_init'))
        {
            echo 'ERROR: Install CURL module for php';
            exit();
        }

        $this->init();
        $this->chat_id = $chat_id;
        $this->api_key = $api_key;
    }

    public function init()
    {
        $this->curl_obj = curl_init();
    }

    public function sendPhoto($caption, $sound, $photo, $type, $link) {
        $url = "https://api.telegram.org/bot".$this->api_key."/";
        $method = 'sendPhoto';

        $caption.=PHP_EOL.PHP_EOL;
        $caption.=$type.PHP_EOL;
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Join Now', 'url' => $link],
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);


        $params = array
        (
            'chat_id' => $this->chat_id,
            'photo' => $photo,
            'reply_to_message_id' => null,
            'reply_markup' => $link?$encodedKeyboard:'',
            'parse_mode' => 'HTML',
            'caption' => $caption
        );
        if ($sound == 's')
        {
            $params['disable_notification'] = TRUE;
        }

        return $this->request($url.$method, 'POST', $params);
    }

    public function sendMediaGroup($caption, $sound, $photo, $type)
    {
        $url = "https://api.telegram.org/bot".$this->api_key."/";
        $method = 'sendMediaGroup';

        $caption.=PHP_EOL.PHP_EOL;
        $caption.=$type.PHP_EOL;

        $media = [];
        foreach ($photo as $key=> $pPath){
            if ($key==0){
                $media[] = [
                    'type' => 'photo',
                    'media' => $pPath,
                    'reply_to_message_id' => null,
                    'caption' => $caption,
                    'parse_mode' => 'HTML',
                ];
            }
            if ($key>0) {
                $media[] = [
                    'type' => 'photo',
                    'media' => $pPath,
                ];
            }
        }

        $params = array
        (
            'chat_id' => $this->chat_id,
            'media' => json_encode($media),
        );
        if ($sound == 's')
        {
            $params['disable_notification'] = TRUE;
        }

        $req = $this->request($url.$method, 'POST', $params);

        return $req;
    }

    public function sendMessage($message, $sound, $redirect = null)
    {
        $url = "https://api.telegram.org/bot".$this->api_key."/";

        $method = 'sendMessage';
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '🌐  Detail', 'url' =>$redirect],
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);

        $params = array
        (
            'chat_id' => $this->chat_id,
            'text' => $message,
            'parse_mode' => 'HTML'

        );
        if ($redirect){
            $params['reply_markup'] = $encodedKeyboard;
        }
        if ($sound == 's')
        {
            $params['disable_notification'] = TRUE;
        }

        return $this->request($url.$method, 'POST', $params);
    }

    public function request($url, $method = 'GET', $params = array(), $opts = array())
    {
        $method = trim(strtoupper($method));

        // default opts
        $opts[CURLOPT_FOLLOWLOCATION] = true;
        $opts[CURLOPT_RETURNTRANSFER] = 1;

        if($method==='GET')
        {
            $url .= "?".$params;
            $params = http_build_query($params);
        }
        elseif($method==='POST')
        {
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
        }

        $opts[CURLOPT_URL] = $url;

        curl_setopt_array($this->curl_obj, $opts);

        $content = curl_exec($this->curl_obj);
        return $content;
    }

    public function close()
    {
        if(gettype($this->curl_obj) === 'resource')
            curl_close($this->curl_obj);
    }

    public function __destruct()
    {
        $this->close();
    }
}
