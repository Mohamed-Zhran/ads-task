<?php

declare(strict_types=1);

namespace App\Domain\Responder\Interfaces;

use Illuminate\Http\JsonResponse;

interface IApiHttpResponder
{
    /**
     *
     * @param mixed $data
     * @param string|null|null $message
     * @param integer $status
     * @return JsonResponse
     */
    public function response(mixed $data = [], string|null $message = null, int $status = 200): JsonResponse;
}
