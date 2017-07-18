<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginFormRequest $request)
    {
        try {
            if (!$token = $this->auth->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'errors' => [
                    'root' => 'Error - Issue with JWT attempt. Please contact an administrator.'
                ]
            ], $e->getStatusCode());
        }

        return response([
            'data' => request()->user(),
        ])
        ->header('Authorization', $token);
    }

    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $this->auth->attempt($request->only('email', 'password'));

        return response([
            'data' => $user,
        ])
        ->header('Authorization', $token);
    }

    public function logout()
    {
        $this->auth->invalidate($this->auth->getToken());

        return null;
    }

    public function user()
    {
        return fractal(request()->user(), new UserTransformer)->toArray();
    }
}
