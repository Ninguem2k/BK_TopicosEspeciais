<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository; 
use App\Repositories\UserTokenRepository; 
use App\Services\AuthenticationServices; 
use App\Providers\DateProvider;
use App\Providers\EmailProvider; 
use Config; 

class AuthController extends Controller
{
    protected $userRepository;
    protected $userTokenRepository;
    protected $dateProvider;
    protected $emailProvider;
    protected $authenticationServices;

    public function __construct(
        UserRepository $userRepository,
        UserTokenRepository $userTokenRepository,
        DateProvider $dateProvider,
        EmailProvider $emailProvider,
        AuthenticationServices $authenticationServices
    ) {
        $this->userRepository = $userRepository;
        $this->userTokenRepository = $userTokenRepository;
        $this->dateProvider = $dateProvider;
        $this->emailProvider = $emailProvider;
        $this->authenticationServices = $authenticationServices;
    }

    public function createSession(Request $request)
    {
        $authenticationUserDTO = $request->all();

        $token = $this->authenticationServices->authenticateUser($authenticationUserDTO);

        return response()->json($token);
    }

    public function createSessionWithCode(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->authenticationServices->validatePasswordChangeCode(
            $credentials['email'],
            $credentials['password']
        );

        return response()->json($token);
    }

    public function recoverPassword(Request $request)
    {
        $email = $request->input('email');

        $this->authenticationServices->validatePasswordChange($email);

        return response()->noContent();
    }

    public function refreshToken(Request $request)
    {
        $refreshToken = $request->input('refreshToken');

        $token = $this->authenticationServices->refreshToken($refreshToken);

        return response()->json($token);
    }
}
