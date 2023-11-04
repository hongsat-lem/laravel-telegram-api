# laravel-telegram-api
Laravel PHP package use to sent telegram notification intergated with laravel. Sent text photo, photo group

## Installation
You can install the package via composer:
```bash
composer require cambodev/laravel-telegram-api
```

## Configuration
##### Laravel 5.5 and above
You don't have to do anything else, this package autoloads the Service Provider and create the Alias, using the new Auto-Discovery feature.
Add the Service Provider and Facade alias to your config/app.php

##### Laravel 5.4 and below
```php
CamboDev\LaravelTelegramApi\TelegramServiceProvider::class,
'TelegramPush' => CamboDev\LaravelTelegramApi\TelegramFacade::class,
```
## .env
TELEGRAM_API_KEY=**************************************

## Using
Use the Facade

use TelegramPush;

##### Test Connection
```php
    $chat_id = '-956xxxxxx';
    $push = TelegramPush::testConnection($chat_id);
```
##### Send Text No Redirect Button
```php
    $chat_id = '-956xxxxxx';
    $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nuncsem vitae risus tristique posuere.';

$push = TelegramPush::sendText($text, $chat_id);
```
##### Send Text with Redirect Button
```php
    $chat_id = '-956xxxxxx';
    $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nuncsem vitae risus tristique posuere.';
    $link = 'your_app_url';

$push = TelegramPush::sendText($text, $chat_id, $link);
```
##### Send Single Photo
```php
    $chat_id = '-956xxxxxx';
    $img = 'https://img.freepik.com/free-vector/colleagues-working-together-project_74855-6308.jpg';
    $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nuncsem vitae risus tristique posuere.';

    $push = TelegramPush::sentMedia($text, $img, $chat_id);
```
##### Send Media Group
```php
    $chat_id = '-956xxxxxx
    $photo = [
            'https://img.freepik.com/premium-vector/website-developer-graphic-designer-work-with-laptop-desk-table_197170-153.jpg',
            'https://img.freepik.com/free-vector/person-talking-online-with-friend_23-2148490053.jpg',
            'https://img.freepik.com/premium-vector/conference-video-call-by-remote-communication-with-online-friends-using-smartphone-illustration_2175-4017.jpg',
        ];
    $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nuncsem vitae risus tristique posuere.';

    $push = TelegramPush::sendMediaGroup($text, $photo, $chat_id);
```
## Option

## License
CamboDev is licensed under the MIT License
