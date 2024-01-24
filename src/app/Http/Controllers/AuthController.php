<?php

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\IUserService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected IUserService $userService, protected IApiHttpResponder $apiHttpResponder)
    {
    }
    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt($request->safe(['email', 'password']))) {
            $token = auth()->guard('sanctum')->user()->createToken('auth_token')->plainTextToken;
            return $this->apiHttpResponder->response(['token' => $token], 'User logged in successfully');
        } else
            return $this->apiHttpResponder->responseError(message: 'credentials are incorrect', status: 401);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->userService->create($request->validated());
            return $this->apiHttpResponder->response(message: 'User is created successfully', status: 201);
        } catch (\Exception $exception) {
            return $this->apiHttpResponder->responseError(message: $exception->getMessage(), status: 500);
        }
    }
}
