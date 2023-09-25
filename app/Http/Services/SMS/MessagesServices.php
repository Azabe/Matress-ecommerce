<?php

namespace App\Http\Services\SMS;

use Illuminate\Support\Facades\Http;

class MessagesServices
{

    public function sendMessage($telephone, $message)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env("SMS_TOKEN") . '',
        ])->acceptJson()
            ->post('https://api.pindo.io/v1/sms/', [
                'sender' => 'DODOMA',
                'to' => '+' . $telephone,
                'text' => $message
            ]);
    }
}
