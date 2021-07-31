<?php

namespace App\Http\Controllers\External\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return NewsResource::collection(News::orderBy('priority', 'desc')->get());
    }
}
