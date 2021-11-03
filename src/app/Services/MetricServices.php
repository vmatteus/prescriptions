<?php

namespace App\Services;

class MetricServices extends BaseServices {

    public function post($data) {

        return $this->doRequest('post', env('API_METRICS_URL') . '/metrics', 'metrics',
            $data, ['Authorization' => env('API_PATIENTS_TOKEN')], null, null, 6, 5);

    }
}
