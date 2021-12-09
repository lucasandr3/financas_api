<?php

namespace App\Http\Interfaces\Services;

interface AuthServiceInterface
{
    public function register(object $request);

    public function login(object $request);
}
