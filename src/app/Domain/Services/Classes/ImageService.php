<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IAdRepository;
use App\Domain\Repositories\Interfaces\IImageRepository;
use App\Domain\Services\Interfaces\IImageService;
use App\Jobs\ProcessImage;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
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

    public function storeOnDisk(UploadedFile $image, string $folder,string $name)
    {
        $path = $image->storeAs($folder, $name);

        ProcessImage::dispatch($path);
        return $path;
    }

    public function compress(string $path)
    {
        ImageManager::read("storage/app/$path")
        ->resize(600, 600)
        ->encode(new PngEncoder(quality: 70))
        ->save("storage/app/$path");
    }
}
