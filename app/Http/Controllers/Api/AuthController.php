<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\ChangePassword;
use App\Http\Requests\Auth\LoginUser;
use App\Http\Requests\Auth\RegisterUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) { }

    /**
     * @param RegisterUser $request
     * @return JsonResponse
     */
    public function register(RegisterUser $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->create($request->getModifiedData());

        return response()->json([
            'user' => $user,
        ], 201);
    }

    /**
     * @param LoginUser $request
     * @return JsonResponse
     */
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

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()?->tokens()->delete();

        return response()->json([
            'message' => __('Logged out')
        ]);
    }

    /**
     * @param ChangePassword $request
     * @return JsonResponse
     */
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