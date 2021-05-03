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
                            'Email' => $insurance->insurer->email,
                            //'Name' => 'You',
                        ],
                    ],
                    'Subject' => 'CLAIM STATUS - '.$patient->full_name.' DOB '.$patient->birth_date->format('m-d-Y'),
                    'TemplateID' => (int) $campaign->template,
                    'TemplateLanguage' => true,
                    'Attachments' => [['ContentType' => 'application/pdf',
                        'Filename' => $patient->full_name.'.pdf',
                        'Base64Content' => $pdf, ]],
                ],
            ],
        ];

        // All resources are located in the Resources class

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        // Read the response

        return $response->success();

        
    }
}
