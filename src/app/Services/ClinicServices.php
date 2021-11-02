<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ClinicServices {

    public function get($id) {
        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_CLINIC_TOKEN')
            ])->get(env('API_CLINIC_URL') . '/clinics/' . $id);
        } catch(\Exception $e) {
            throw new \Exception('clinic service not available', '05');
        }

        if ($response->successful()) {
            return $response->body();
        } else {
            switch($response->status()) {
                case '404' :
                    throw new \Exception('clinic not found', '02');
                default:
                    throw new \Exception('malformed request', '01');
            }
        }
    }
}
