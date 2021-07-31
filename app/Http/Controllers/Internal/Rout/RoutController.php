<?php

namespace App\Http\Controllers\Internal\Rout;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\RoutResource;
use App\Models\Rout;
use App\Traits\Functions\GetValueOrNull;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoutController extends Controller
{
    use GetValueOrNull;

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return RoutResource::collection(Rout::orderBy('year', 'desc')->get());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'year'             => 'required|integer',
            'king'             => 'required|string|max:255',
            'firstKnight'      => 'nullable|string|max:255',
            'secondKnight'     => 'nullable|string|max:255',
            'youthKing'        => 'nullable|string|max:255',
            'citizenKing'      => 'nullable|string|max:255',
            'citizenYouthKing' => 'nullable|string|max:255'
        ]);

        if (Rout::where('year', $data['year'])->exists()) {
            return response()->json([
                'message' => 'Es existiert schon ein Gespann für dieses Jahr.'
            ], Response::HTTP_CONFLICT);
        }

        try {
            Rout::create([
                'year'               => $data['year'],
                'king'               => $data['king'],
                'first_knight'       => $this->getValueOrNull($data, 'firstKnight'),
                'second_knight'      => $this->getValueOrNull($data, 'secondKnight'),
                'youth_king'         => $this->getValueOrNull($data, 'youthKing'),
                'citizen_king'       => $this->getValueOrNull($data, 'citizenKing'),
                'citizen_youth_king' => $this->getValueOrNull($data, 'citizenYouthKing')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Gespann wurde erstellt.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param Rout $rout
     * @return JsonResponse
     */
    public function update(Request $request, Rout $rout): JsonResponse
    {
        $data = $request->validate([
            'king'             => 'required|string|max:255',
            'firstKnight'      => 'nullable|string|max:255',
            'secondKnight'     => 'nullable|string|max:255',
            'youthKing'        => 'nullable|string|max:255',
            'citizenKing'      => 'nullable|string|max:255',
            'citizenYouthKing' => 'nullable|string|max:255'
        ]);

        try {
            $rout->update([
                'king'               => $data['king'],
                'first_knight'       => $this->getValueOrNull($data, 'firstKnight'),
                'second_knight'      => $this->getValueOrNull($data, 'secondKnight'),
                'youth_king'         => $this->getValueOrNull($data, 'youthKing'),
                'citizen_king'       => $this->getValueOrNull($data, 'citizenKing'),
                'citizen_youth_king' => $this->getValueOrNull($data, 'citizenYouthKing')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Gespann wurde bearbeitet.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Rout $rout
     * @return JsonResponse
     */
    public function delete(Rout $rout): JsonResponse
    {
        try {
            $rout->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Gespann wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
