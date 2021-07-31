<?php

namespace App\Http\Controllers\Internal\ActivityLog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\ActivityLogResource;
use App\Models\ActivityLog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityLogController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ActivityLogResource::collection(
            ActivityLog::take(50)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }
}
