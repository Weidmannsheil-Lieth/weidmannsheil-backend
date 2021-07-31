<?php

namespace App\Http\Controllers\Internal\Administration;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\AdministrationResource;
use App\Models\Administration;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AdministrationController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AdministrationResource::collection(Administration::orderBy('priority', 'desc')->get());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'priority' => 'required|integer|min:1|max:999',
            'name'     => 'required|string|max:255',
            'members'  => 'required|string|max:255',
            'email'    => 'required|string|max:255'
        ]);

        try {
            Administration::create($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Leitung wurde erstellt.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param Administration $administration
     * @return JsonResponse
     */
    public function update(Request $request, Administration $administration): JsonResponse
    {
        $data = $request->validate([
            'priority' => 'required|integer|min:1|max:999',
            'name'     => 'required|string|max:255',
            'members'  => 'required|string|max:255',
            'email'    => 'required|string|max:255'
        ]);

        try {
            $administration->update($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Leitung wurde bearbeitet.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Administration $administration
     * @return JsonResponse
     */
    public function delete(Administration $administration): JsonResponse
    {
        try {
            $administration->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Leitung wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
