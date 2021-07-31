<?php

namespace App\Http\Controllers\External\Administration;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\AdministrationResource;
use App\Http\Resources\External\NewsResource;
use App\Models\Administration;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdministrationController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AdministrationResource::collection(Administration::orderBy('priority', 'desc')->get());
    }
}
