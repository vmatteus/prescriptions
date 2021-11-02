<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PatientServices extends BaseServices{

    public function get($id) {

        return $this->doRequest('get', env('API_PATIENTS_URL') . '/patients/' . $id, 'patient',
            [], ['Authorization' => env('API_PATIENTS_TOKEN')], 12, $id, 2);

    }
}
