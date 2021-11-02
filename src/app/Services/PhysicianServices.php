<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PhysicianServices extends BaseServices{

    public function get($id) {

        return $this->doRequest('get', env('API_PHYSICIANS_URL') . '/physicians/' . $id, 'physician',
            [], ['Authorization' => env('API_PHYSICIANS_TOKEN')], 2880, $id, 4, 2);

    }
}
