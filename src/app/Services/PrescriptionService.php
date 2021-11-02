<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Prescription;
use stdClass;

class PrescriptionService {

    public function create(array $data)
    {
        DB::beginTransaction();

        // Save Prescriptions
        $prescription = new Prescription;
        $prescription->clinic_id = $data['clinic']['id'];
        $prescription->physician_id = $data['physician']['id'];
        $prescription->patient_id = $data['patient']['id'];
        $prescription->text = $data['text'];

        // Get Clinic
        try{
            $clinic = App::make(ClinicServices::class)->get($data['clinic']['id']);
            $clinic = json_decode($clinic);
        } catch (\Exception $e) {
            $clinic = new stdClass;
            $clinic->clinic_id = $data['clinic']['id'];
            $clinic->name = null;
        }

        // Get Physicians
        $physicians = App::make(PhysicianServices::class)->get($data['physician']['id']);
        $physicians = json_decode($physicians);

        // Get Patients
        $patient = App::make(PatientServices::class)->get($data['patient']['id']);
        $patient = json_decode($patient);

        $prescription->save();

        // Send Metrics
        $body = [
            'clinic_id' => $clinic->id,
            'clinic_name' => $clinic->name,
            'physician_id' => $physicians->id,
            'physician_name' => $physicians->name,
            'physician_crm' => $physicians->crm,
            'patient_id' => $patient->id,
            'patient_name' => $patient->name,
            'patient_email' => $patient->email,
            'patient_phone' => $patient->phone,
            'prescription_id' => $prescription->id,
        ];

        $metrics = App::make(MetricServices::class)->post($body);
        $metrics = json_decode($metrics);

        $prescription->metric_id = $metrics->id;

        $prescription->save();
        DB::commit();

        return $prescription;
    }

}
