<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IAdRepository;
use App\Domain\Repositories\Interfaces\IImageRepository;
use App\Domain\Services\Interfaces\IImageService;
use App\Jobs\ProcessImage;
use App\Models\Image;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Laravel\Facades\Image as ImageManager;

class ImageService implements IImageService
{
    /**
     * @param  ImageRepository  $ImageRepository
     */
    public function __construct(protected IImageRepository $ImageRepository, protected IAdRepository $adRepository)
    {
    }

    public function create(array $data)
    {
        $name = "ad_" . uniqid() . '.' . $data['image']->extension();
        $path = $data['image']->storeAs('images', $name);
        $image = $this->adRepository->findById((int)$data['ad_id'])->image()->create([
            'path' => $path,
            'name' => $name
        ]);

        ProcessImage::dispatch($image);
        return $image;
    }

    public function compress(Image $image)
    {
        ImageManager::read("storage/app/$image->path")
        ->resize(600, 600)
        ->encode(new PngEncoder(quality: 70))
        ->save("storage/app/$image->path");
    }
}
