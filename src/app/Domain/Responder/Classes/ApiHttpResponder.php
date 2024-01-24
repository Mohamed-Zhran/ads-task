<?php

declare(strict_types=1);

namespace App\Domain\Responder\Classes;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use Illuminate\Http\JsonResponse;

class ApiHttpResponder implements IApiHttpResponder
{
    /**
     * @param array<string,int> $data
     * @param null|string       $message
     *
     */
    public function response(mixed $data = [], string|null $message = null, int $status = 200): JsonResponse
    {
        return response()->json(array_filter([
            'message' => $message,
            'data' => $data,
        ]), $status);
    }

    /**
     * @param null|string $message
     */
    public function responseError(array $data = [], string|null $message = null, int $status = 422): JsonResponse
    {
        return response()->json(array_filter([
            'message' => $message,
            'error' => $data,
        ]), $status);
    }
}
