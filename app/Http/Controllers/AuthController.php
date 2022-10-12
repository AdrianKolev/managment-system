<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

use function Ramsey\Uuid\v1;

class AuthController extends Controller
{
    /**
     * Register the user
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response($user, HttpFoundationResponse::HTTP_CREATED);
    }


    /**
     * Login the user
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {

            return \response(
                [
                    'error' => 'Invalid Credentials',
                ],
                HttpFoundationResponse::HTTP_UNAUTHORIZED
            );
        };

        /** @var User $user */
        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        
        // Create cookie which will live 1 day
        $cookie = cookie('jwt', $token, 60 * 24);
        
        // The token will be accessible only from the backend -> http only
        return \response(
            [
                'jwt' => $token
            ]
        )->withCookie($cookie);
    }

    /**
     * Get the authorized user
     *
     * @param Request $request
     * @return void
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return \response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}
