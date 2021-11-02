<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PhysicianServices {

    public function get($id) {
        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_PHYSICIANS_TOKEN')
            ])->get(env('API_PHYSICIANS_URL') . '/physicians/' . $id);
        } catch(\Exception $e) {
            throw new \Exception('physicians service not available', '05');
        }

        if ($response->successful()) {
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
