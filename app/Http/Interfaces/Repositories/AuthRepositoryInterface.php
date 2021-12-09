<?php

namespace App\Http\Interfaces\Repositories;

interface AuthRepositoryInterface
{
    public function registerUser(object $request);

    public function loginUser(array $credentials);
}
