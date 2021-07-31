<?php

namespace App\Http\Controllers\External\Notice;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NoticeController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return NoticeResource::collection(Notice::orderBy('id', 'desc')->get());
    }
}
