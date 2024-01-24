<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IAdRepository;
use App\Domain\Services\Interfaces\IAdService;
use App\Domain\Services\Interfaces\IImageService;
use App\Models\Ad;
use App\Models\Image;
use Illuminate\Http\UploadedFile;

class AdService implements IAdService
{
    /**
     * @param  AdRepository  $adRepository
     */
    public function __construct(protected IAdRepository $adRepository, protected IImageService $imageService)
    {
    }

    public function create(array $data): mixed
    {
        return auth()->user()->ads()->create($data);
    }

    public function attachImage(int $adId, UploadedFile $image)
    {
        $name = "ad_" . uniqid() . '.' . $image->extension();
        $path = $this->imageService->storeOnDisk($image, 'ads', $name);

        $image = $this->adRepository->findById($adId)->image()->create([
            'path' => $path,
            'name' => $name
        ]);

        return $image;
    }
}
