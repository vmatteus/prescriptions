<?php

namespace App\Services;

class ClinicServices extends BaseServices{

    public function get($id) {

        return $this->doRequest('get', env('API_CLINIC_URL') . '/clinics/' . $id, 'clinic',
            [], ['Authorization' => env('API_CLINIC_TOKEN')], 4320, $id, 5, 3);

    }
}
