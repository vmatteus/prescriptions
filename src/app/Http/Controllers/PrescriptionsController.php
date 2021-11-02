<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Requests\PrescriptionRequest;
use App\Transformers\PrescriptionTransformer;
use App\Services\PrescriptionService;

class PrescriptionsController extends Controller
{

    private $service;

    public function __construct(PrescriptionService $service)
    {
        $this->service = $service;
    }

    public function create(PrescriptionRequest $request)
    {
        $data = $request->validated();
        try {
            $prescription = $this->service->create($data);
            $collection = App::make(PrescriptionTransformer::class)->transform($prescription);
            return $this->requestResponse($collection);
        } catch(\Exception $e) {
           return $this->requestResponseError($e);
        }

    }

}
