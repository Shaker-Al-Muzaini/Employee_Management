<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\WorkerStoreRequest;
use App\Models\Worker;
use App\Services\WorkerService\WorkerAuthService\WorkerLoginService;
use App\Services\WorkerService\WorkerAuthService\WorkerRegisterService;
use Illuminate\Http\Request;
use Validator;

class AuthWorkerController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:worker', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        return (new WorkerLoginService())->login($request);
    }
    /**
     * Register a Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(WorkerStoreRequest $request) {
        return   (new WorkerRegisterService())->register($request);
    }

    /**
     * Log the Admin out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->guard('worker')->logout();
        return response()->json(['message' => 'Worker successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function AdminProfile() {
        return response()->json(auth()->guard('worker')->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'worker' => auth()->guard('worker')->user()
        ]);
    }
}
