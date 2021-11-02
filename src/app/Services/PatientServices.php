<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PatientServices {

    public function get($id) {
        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_PATIENTS_TOKEN')
            ])->get(env('API_PATIENTS_URL') . '/patients/' . $id);
        } catch(\Exception $e) {
            throw new \Exception('patients service not available', '05');
        }

        if ($response->successful()) {
            return $response->body();
        } else {
            switch($response->status()) {
                case '404' :
                    throw new \Exception('patients not found', '02');
                default:
                    throw new \Exception('malformed request', '01');
            }
        }
    }
}
