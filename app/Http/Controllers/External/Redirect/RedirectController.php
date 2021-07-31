<?php

namespace App\Http\Controllers\External\Redirect;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\RedirectResource;
use App\Http\Resources\External\ResultResource;
use App\Models\Redirect;
use App\Models\Result;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * @param Redirect $redirect
     * @return RedirectResource
     */
    public function show(Redirect $redirect): RedirectResource
    {
        return new RedirectResource($redirect);
    }
}
