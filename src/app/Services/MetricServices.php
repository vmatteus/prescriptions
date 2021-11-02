<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MetricServices {

    public function post($data) {

        // Add fake, request not available
        Http::fake([
            '*' => Http::response('{
                "id": '. str_pad(rand(0,999999),6, "0", STR_PAD_LEFT) .',
                "clinic_id": 1,
                "clinic_name": "Clinica A",
                "physician_id": 1,
                "physician_name": "Dr. João",
                "physician_crm": "SP293893",
                "patient_id": 1,
                "patient_name": "Rodrigo",
                "patient_email": "rodrigo@gmail.com",
                "patient_phone": "(16)998765625",
                "prescription_id": 1
            }', 200, ['Headers']),
        ]);

        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_METRICS_TOKEN')
            ])->post(env('API_METRICS_URL') . '/metrics', $data);
        } catch(\Exception $e) {
            throw new \Exception('metrics service not available', '05');
        }

        if ($response->successful()) {
            return $response->body();
        } else {
            switch($response->status()) {
                case '404' :
                    throw new \Exception('metrics not found', '02');
                default:
                    throw new \Exception('malformed request', '01');
            }
        }
    }
}
