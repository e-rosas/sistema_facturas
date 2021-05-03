<?php

namespace App\Http\Controllers;

use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

    class MailjetController extends Controller
    {
        public function sendEmail()
        {
            $mj = Mailjet::getClient();
            $body = [
                'FromEmail' => env('MAIL_FROM_ADDRESS'),
                'FromName' => env('MAIL_FROM_NAME'),
                'Subject' => 'Videoconsulta',
                'MJ-TemplateID' => 2327286,
                'MJ-TemplateLanguage' => true,
                'Recipients' => [['Email' => 'edgar@hospitalmexico.org']],
                'Vars' => json_decode('{"greeting": "TEST2"}', true),
            ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success() && var_dump($response->getData());
        }
    }