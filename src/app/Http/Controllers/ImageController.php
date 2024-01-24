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
}
