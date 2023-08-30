<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Worker;
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
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if ( ! $token = auth()->guard('worker')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:workers',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            'photo' => 'required|image',
            'location' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Worker = Worker::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                 'photo' => $request->file('photo')->store('Worker'),
            ]
        ));
        return response()->json([
            'message' => 'Worker successfully registered',
            'Worker' => $Worker
        ], 201);
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
