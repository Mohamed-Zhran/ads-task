<?php

namespace App\Providers;

use App\Domain\Repositories\Classes\AdRepository;
use App\Domain\Repositories\Classes\ImageRepository;
use App\Domain\Repositories\Classes\UserRepository;
use App\Domain\Repositories\Interfaces\IAdRepository;
use App\Domain\Repositories\Interfaces\IImageRepository;
use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Domain\Responder\Classes\ApiHttpResponder;
use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Classes\AdService;
use App\Domain\Services\Classes\ImageService;
use App\Domain\Services\Classes\UserService;
use App\Domain\Services\Interfaces\IAdService;
use App\Domain\Services\Interfaces\IImageService;
use App\Domain\Services\Interfaces\IUserService;
use App\Models\Ad;
use App\Models\Image;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IAdService::class, AdService::class);
        $this->app->bind(IImageService::class, ImageService::class);
        $this->app->bind(IApiHttpResponder::class, ApiHttpResponder::class);

        $this->app->bind(IUserRepository::class, function (Application $app) {
            return new UserRepository($app->make(User::class));
        });
        $this->app->bind(IImageRepository::class, function (Application $app) {
            return new ImageRepository($app->make(Image::class));
        });
        $this->app->bind(IAdRepository::class, function (Application $app) {
            return new AdRepository($app->make(Ad::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
