<?php

// use Intervention\Image\Laravel\Facades\Image as ImageManager;
// use Intervention\Image\Encoders\JpegEncoder;

// ImageManager::read("storage/app/images/ad_65b150d040b3a.png")->resize(600, 600)->save("storage/app/images/ad_2.png");

// ImageManager::read("storage/app/images/ad_65b150d040b3a.png")->resize(600, 600)->encode(new JpegEncoder(quality:70))->save("storage/app/images/ad_2.jpg");

use App\Models\Image;

Image::truncate();
