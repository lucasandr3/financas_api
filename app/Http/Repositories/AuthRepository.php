<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{

    public function registerUser(object $request)
    {
        try {

            $user = new User;
            $user->full_name = $request->input('full_name');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = app('hash')->make($request->input('password'));

            $user->save();
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar usuário!'], 409);
        }
    }

    public function loginUser(array $credentials)
    {
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $this->respondWithToken($token);
        return $token->getData()->token;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
