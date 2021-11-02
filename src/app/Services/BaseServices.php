<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class BaseServices {

    public function doRequest($type, $url, $name_service, $body=[], $header=[], $time_to_cache = null, $data_id=null, $timeout=10, $attempts=1) {

        $cache_service_result = null;
        if (!is_null($time_to_cache) && !is_null($data_id)) {
            $cache_service_result = Cache::store(env('CACHE_DRIVER'))->get($name_service . $data_id);
        }

        $try_again = true;
        $i = 0;

        do {
            $i++;
            try{

                if (!is_null($cache_service_result)) {
                    return $cache_service_result;
                }

                $request = Http::timeout($timeout)->withHeaders($header);

                switch ($type) {
                    case 'get':
                        $response = $request->get($url);
                    break;
                    case 'post':
                        $response = $request->post($url, $body);
                    break;
                        default:
                            throw new \Exception('Request type invalid', '');
                }

                $try_again = false;

            } catch(\Exception $e) {
                if ($i == $attempts) {
                    throw new \Exception($name_service . ' service not available', '05');
                }
            }
        } while ($try_again);


        if ($response->successful()) {
            if (!is_null($time_to_cache) && !is_null($data_id)) {
                Cache::put($name_service . $data_id, $response->body(), $time_to_cache);
            }
            return $response->body();
        } else {
            switch($response->status()) {
                case '404' :
                    throw new \Exception($name_service . ' not found', '02');
                default:
                    throw new \Exception('malformed request', '01');
            }
        }
    }
}
