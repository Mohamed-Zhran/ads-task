<?php

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\IAdService;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;

class AdController extends Controller
{
    public function __construct(protected IAdService $adService, protected IApiHttpResponder $apiHttpResponder)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdRequest $request)
    {
        try {
            $ad = $this->adService->create($request->validated());
            return $this->apiHttpResponder->response(data: $ad, message: 'Ad is created successfully');
        } catch (\Exception $e) {
            return $this->apiHttpResponder->responseError(message: $e->getMessage());
        }
    }
}
