<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PatientServices {

    public function get($id) {

        $patient = Cache::store(env('CACHE_DRIVER'))->get('patient.' . $id);

        try{
            if (!is_null($patient)) {
                return $patient;
            }
            $response = Http::withHeaders([
                'Authorization' => env('API_PATIENTS_TOKEN')
            ])->get(env('API_PATIENTS_URL') . '/patients/' . $id);
        } catch(\Exception $e) {
            throw new \Exception('patients service not available', '05');
        }

        if ($response->successful()) {
            Cache::put('patient.' . $id, $response->body(), 12);
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
