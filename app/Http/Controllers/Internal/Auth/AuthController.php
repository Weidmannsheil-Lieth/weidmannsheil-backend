<?php

namespace App\Http\Controllers\Internal\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\AuthResource;
use App\Models\LoginLog;
use App\Models\User;
use App\Traits\Functions\CreateLoginLog;
use App\Traits\Functions\GetIpAddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use CreateLoginLog;

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($data)) {
            $this->createLoginLog(LoginLog::ACTION_LOGIN_FAILED, $data['username']);
            return response(null, Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $user->forceFill([
            'api_token' => Str::random(80)
        ]);
        $user->save();

        $this->createLoginLog(LoginLog::ACTION_LOGIN_SUCCESS, $data['username']);

        return response()->json([
            'user' => new AuthResource($user)
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuth(Request $request): JsonResponse
    {
        return response()->json([
            'user' => new AuthResource(Auth::user())
        ]);
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->forceFill([
            'api_token' => null
        ]);
        $user->save();

        $this->createLoginLog(LoginLog::ACTION_LOGOUT, $user->username);

        return response(null, Response::HTTP_OK);
    }
}
