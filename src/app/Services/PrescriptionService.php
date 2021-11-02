<?php

namespace App\Services;

use App\Models\Prescription;

class PrescriptionService {

    public function create(array $data)
    {
        $interest = new Prescription;
        $interest->clinic_id = $data['clinic']['id'];
        $interest->physician_id = $data['physician']['id'];
        $interest->patient_id = $data['patient']['id'];
        $interest->text = $data['text'];
        $interest->save();
        return $interest;
    }

}
