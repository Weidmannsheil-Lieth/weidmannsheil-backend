<?php

namespace App\Http\Controllers\External\RoutHistory;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\RoutResource;
use App\Models\Rout;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoutHistoryController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return RoutResource::collection(Rout::all());
    }
}
