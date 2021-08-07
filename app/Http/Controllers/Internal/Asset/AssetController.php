<?php

namespace App\Http\Controllers\Internal\Asset;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\AssetResource;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    protected function index(): AnonymousResourceCollection
    {
        $assets = Asset::all();
        return AssetResource::collection($assets);
    }

    /**
     * @param \App\Models\Asset $asset
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(Asset $asset): JsonResponse
    {
        $request = request();
        if (!$request->hasFile('file')) {
            return response()->json([
                'message' => 'Die Datei fehlt.'
            ], Response::HTTP_CONFLICT);
        }

        $file = $request->file('file');
        if ($file->getMimeType() !== $asset->mime) {
            return response()->json([
                'message' => 'Die Datei ist nicht kompatibel.'
            ], Response::HTTP_CONFLICT);
        }

        $path = Str::beforeLast($asset->path, '/');
        $name = Str::afterLast($asset->path, '/');
        $file->storeAs($path, $name, 'assets');

        $asset->updated_at = now();
        $asset->save();

        return response()->json([
            'message' => 'Die Datei wurde aktualisiert.'
        ]);
    }
}
