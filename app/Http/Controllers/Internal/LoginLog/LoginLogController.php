<?php

namespace App\Http\Controllers\Internal\LoginLog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\LoginLogResource;
use App\Models\LoginLog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LoginLogController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return LoginLogResource::collection(
            LoginLog::take(50)
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }
}
