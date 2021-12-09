<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct
    (
        AuthServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
       return $this->service->register($request);
    }

    public function login(Request $request)
    {
        return $this->service->login($request);
    }

    public function unauthorized()
    {
        return response()->json('Unauthorizwed', 401);
    }
}
