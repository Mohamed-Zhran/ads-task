<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IAdRepository;
use App\Domain\Services\Interfaces\IAdService;

class AdService implements IAdService
{
    /**
     * @param  AdRepository  $adRepository
     */
    public function __construct(protected IAdRepository $adRepository)
    {
    }

    public function create(array $data): mixed
    {
        return auth()->user()->ads()->create($data);
    }
}
