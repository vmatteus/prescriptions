<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PhysicianServices {

    public function get($id) {

        $physician = Cache::store(env('CACHE_DRIVER'))->get('physician.' . $id);

        try{
            if (!is_null($physician)) {
                return $physician;
            }
            $response = Http::withHeaders([
                'Authorization' => env('API_PHYSICIANS_TOKEN')
            ])->get(env('API_PHYSICIANS_URL') . '/physicians/' . $id);
        } catch(\Exception $e) {
            throw new \Exception('physicians service not available', '05');
        }

        if ($response->successful()) {
            Cache::put('physician.' . $id, $response->body(), 2880);
            return $response->body();
        } else {
            switch($response->status()) {
                case '404' :
                    throw new \Exception('physician not found', '02');
                default:
                    throw new \Exception('malformed request', '01');
            }
        }
    }
}
