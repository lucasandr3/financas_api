<?php

namespace App\Http\Services;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\AuthRepositoryInterface;
use App\Http\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Validator;

class AuthService implements AuthServiceInterface
{
    private $repository;

    public function __construct
    (
        AuthRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function register(object $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if (!$validator->fails()) {

           return response()->json($this->repository->registerUser($request), '200');

        } else {
            return response()->json($validator->errors());
        }
    }

    public function login(object $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validator->fails()) {

            $credentials = $request->only(['email', 'password']);
            return response()->json($this->repository->loginUser($credentials), 201);

        } else {
            return response()->json($validator->errors());
        }
    }
}
