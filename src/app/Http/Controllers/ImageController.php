<?php

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\IImageService;
use App\Http\Requests\StoreImageRequest;

class ImageController extends Controller
{
    public function __construct(protected IImageService $imageService, protected IApiHttpResponder $apiHttpResponder)
    {
    }

    public function store(StoreImageRequest $request)
    {
        try {
            $image=$this->imageService->create($request->validated());
            return $this->apiHttpResponder->response(data: $image->path, message: 'Image is created successfully');
        } catch (\Exception $e) {
            return $this->apiHttpResponder->responseError(message: $e->getMessage(), status: 500);
        }
    }
}
