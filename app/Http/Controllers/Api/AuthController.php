<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Http\Requests\Auth\ChangePassword;
use Http\Requests\Auth\LoginUser;
use Http\Requests\Auth\RegisterUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Repositories\UserRepository;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) { }

    public function register(RegisterUser $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->create($request->getModifiedData());

//        $token = $user->createToken('authtoken')->plainTextToken;

        return response()->json([
            'user' => $user,
//            'token' => $token
        ], 201);
    }

    public function login(LoginUser $request): JsonResponse
    {
        $data = $request->getModifiedData();

        $user = User::query()->where('code', $data['code'])->first();

        if (!$user || Hash::check(bcrypt($data['password']), $user->password)) {
            return response()->json([
                'message' => 'Incorrect credentials'
            ], 401);
        }

        $token = $user->createToken('authtoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()?->tokens()->delete();

        return response()->json([
            'message' => __('Logged out')
        ]);
    }

    public function changePassword(ChangePassword $request): JsonResponse
    {
        $data = $request->getModifiedData();

        $user = $this->userRepository->find(intval($data['id'])) ?? auth()->user();

        $user = $user->update([
            'password' => $data['password']
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Password changed'
        ]);
    }
}