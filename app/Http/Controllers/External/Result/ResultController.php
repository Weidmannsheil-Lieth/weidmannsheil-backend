<?php

namespace App\Http\Controllers\External\Result;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        $results = Result::all();

        $return = [];
        foreach ($results as $result) {
            if (!array_key_exists($result->category, $return)) {
                $return[$result->category] = [];
            }
            $return[$result->category][] = new ResultResource($result);
        }

        return $return;
    }
}
