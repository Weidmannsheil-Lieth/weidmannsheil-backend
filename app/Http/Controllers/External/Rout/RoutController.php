<?php

namespace App\Http\Controllers\External\Rout;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\RoutResource;
use App\Models\Rout;

class RoutController extends Controller
{
    /**
     * @return RoutResource
     */
    public function index(): RoutResource
    {
        $current = Rout::whereRaw('year = (select max(`year`) from routs)')->first();
        return new RoutResource($current);
    }
}
