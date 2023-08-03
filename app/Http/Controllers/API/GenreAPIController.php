<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationAPIRequest;
use App\Http\Requests\StoreGenreAPIRequest;
use App\Http\Requests\UpdateGenreAPIRequest;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Js;
use Psy\Util\Json;
use function PHPUnit\Framework\isNull;

class GenreAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginationAPIRequest $request): JsonResponse
    {
        $genres = Genre::paginate($request['per_page']);

        if (!is_null($genres) && $genres->count() > 0) {
            return $this->sendResponse(
                $genres,
                "Retrieved successfully.",
            );
        }

        return $this->sendError("No Genres Found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreAPIRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $genre = Genre::create($validated);
        return response()->json(
            [
                'success' => true,
                'message' => "Created successfully.",
                'data' => [
                    'genres' => $genre,
                ],
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $genre = Genre::find($id);

        if (isset($genre) && $genre->count() > 0) {
            return $this->sendResponse(
                $genre,
                "Retrieved successfully.",
            );
        }

        return $this->sendError("User Not Found");
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateGenreAPIRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $genre = Genre::query()->where('id', $id)->first();

        if (!is_null($genre) && $genre->count() > 0) {
            $genre['name'] = $validated['name'];
            $genre['description'] = $validated['description'];
            $genre['updated_at'] = Carbon::now();
            $genre->save();

            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Updated successfully.",
                    'genre' => $genre
                ],
                200  # Ok
            );
            return $response;

        }
        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Genre Not Found",
                'genres' => null
            ],
            404  # Not Found
        );
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(UpdateGenreAPIRequest $request, string $id): JsonResponse
    {
        $genre = Genre::query()->where('id', $id)->first();
        $destroyedGenre = $genre;

        if (!is_null($genre) && $genre->count() > 0) {
            $genre->delete();

            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Genre Deleted.",
                    'genre' => $destroyedGenre
                ],
                200  # Ok
            );
            return $response;

        }
        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Genre Not Found",
                'genres' => null
            ],
            404  # Not Found
        );
        return $response;

    }}
