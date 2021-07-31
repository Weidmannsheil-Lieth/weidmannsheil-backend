<?php

namespace App\Http\Controllers\Internal\Result;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\ResultResource;
use App\Models\Result;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    protected string $disk = 'results';

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ResultResource::collection(Result::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeRedirect(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'redirect' => 'required|string',
        ]);

        return $this->createResult([
            'category'       => $data['category'],
            'name'           => $data['name'],
            'content_type'   => Result::TYPE_REDIRECT,
            'content_action' => $data['redirect']
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeDownload(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category'     => 'required|string',
            'name'         => 'required|string',
            'downloadFile' => 'required|file',
        ]);

        $file = $request->file('downloadFile');
        $filename = Str::snake($data['category']) . '_' . Str::snake($data['name']) . '.' . $file->getClientOriginalExtension();
        if (strlen($filename) > 255) {
            return response()->json([
                'message' => 'Der Name und die Kategorie zusammengesetzt sind zu lang.'
            ], Response::HTTP_CONFLICT);
        }

        if (Storage::disk($this->disk)->exists($filename)) {
            return response()->json([
                'message' => 'Diese Datei existiert schon.'
            ], Response::HTTP_CONFLICT);
        }

        if (!Storage::disk($this->disk)->putFileAs(DIRECTORY_SEPARATOR, $file, $filename)) {
            return response()->json([
                'message' => 'Die Datei konnte nicht abgelegt werden.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->createResult([
            'category'       => $data['category'],
            'name'           => $data['name'],
            'content_type'   => Result::TYPE_DOWNLOAD,
            'content_action' => '/' . $filename
        ]);
    }

    /**
     * @param Request $request
     * @param Result $result
     * @return JsonResponse
     */
    public function update(Request $request, Result $result): JsonResponse
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
        ]);

        try {
            $result->update($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Ergebnis wurde bearbeitet.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Result $result
     * @return JsonResponse
     */
    public function delete(Result $result): JsonResponse
    {
        try {
            $result->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($result->content_type === Result::TYPE_DOWNLOAD) {
            Storage::disk($this->disk)->delete($result->content_action);
            if (Storage::disk($this->disk)->exists($result->content_action)) {
                return response()->json([
                    'message' => 'Die Datei konnte nicht gelöscht werden.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return response()->json([
            'message' => 'Das Ergebnis wurde gelöscht.'
        ], Response::HTTP_OK);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function createResult($data): JsonResponse
    {
        try {
            Result::create($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Ergebnis wurde erstellt.'
        ], Response::HTTP_CREATED);
    }
}
