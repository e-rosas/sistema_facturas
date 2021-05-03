<?php

namespace App\Actions;

use App\Campaign;
use App\Email;
use App\Insurance;
use Carbon\Carbon;
use Mailjet\Resources;

class SendMailjet
{
    public function sendCampaignEmail(Campaign $campaign, Insurance $insurance, $patient, $letter, $user_id)
    {
        $apikey = env('MAILJET_APIKEY');
        $apisecret = env('MAILJET_APISECRET');
        $mj = new \Mailjet\Client($apikey, $apisecret, true, ['version' => 'v3.1']);
        $pdf = (base64_encode(file_get_contents(($letter))));
        // Define your request body

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => env('MAIL_FROM_ADDRESS'),
                        'Name' => env('MAIL_FROM_NAME'),
                    ],
                    'To' => [
                        [
                            'Email' => 'hospmex.sistemas@gmail.com',
                            //'Name' => 'You',
                        ],
                    ],
                    'Subject' => 'CLAIM STATUS - '.$patient->full_name.' DOB '.$patient->birth_date->format('m-d-Y'),
                    'TemplateID' => (int) $campaign->template,
                    'TemplateLanguage' => true,
                    'Variables' => json_decode('{"test": "TEST2"}', true),
                    'Attachments' => [['ContentType' => 'application/pdf',
                        'Filename' => $patient->full_name.'.pdf',
                        'Base64Content' => $pdf, ]],
                ],
            ],
        ];

        // All resources are located in the Resources class

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Read the response

        if ($response->success()) {
            $e = new Email();
            $e->campaign_id = $campaign->id;
            $e->patient_id = $patient->id;
            $e->insurance_id = $insurance->id;
            $e->user_id = $user_id;
            $e->date = Carbon::now();
            $e->save();

            return true;
        }

        return false;
        /* $mj = Mailjet::getClient();
        $pdf = (base64_encode(file_get_contents(($letter))));
        $body = [
            'FromEmail' => env('MAIL_FROM_ADDRESS'),
            'FromName' => env('MAIL_FROM_NAME'),
            'Subject' => 'CLAIM STATUS - '.$patient->full_name . ' DOB ' .$patient->birth_date->format('m-d-Y'),
            'MJ-TemplateID' => $campaign->template,
            'MJ-TemplateLanguage' => true,
            'Vars' => json_decode('{"test": "TEST2"}', true),
            'Recipients' => [['Email' => 'hospmex.sistemas@gmail.com']],
            'Attachments' => [['ContentType' => 'application/pdf',
                'Filename' => 'letter.pdf',
                'Base64Content' => $pdf, ]],
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        if ($response->success()) {
            var_dump($response->getData());
        } else {
            dd($response);
        } */
    }
}
