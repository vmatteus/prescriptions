<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class ViaCepTransformer
 * @package namespace App\Transformers;
 */
class PrescriptionTransformer extends TransformerAbstract
{
    /**
     * Transform an address
     *
     * @param array $address Array containing the ViaCep address
     *
     * @return array
     */
    public function transform($entity)
    {
        return [
            'id'           => $entity->id,
            'clinic_id'    => $entity->clinic_id,
            'physician_id' => $entity->physician_id,
            'patient_id'   => $entity->patient_id,
            'text'         => $entity->text,
            'metric_id'    => $entity->metric_id,
        ];
    }

}
