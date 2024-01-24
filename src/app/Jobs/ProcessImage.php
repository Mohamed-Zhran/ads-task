<?php

namespace App\Jobs;

use App\Domain\Services\Interfaces\IImageService;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $path)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(IImageService $imageService): void
    {
        $imageService->compress($this->path);
    }
}
