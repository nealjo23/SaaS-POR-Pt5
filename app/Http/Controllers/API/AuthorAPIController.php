<?php

namespace App\Http\Controllers\API;

//use App\Http\Requests\AuthorSearchAPIRequest;
use App\Http\Requests\PaginationAPIRequest;
use App\Http\Requests\StoreAuthorAPIRequest;
use App\Http\Requests\UpdateAuthorAPIRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;


/**
 * @group Author API
 *
 * API endpoints for managing authors
 */
class AuthorAPIController extends ApiBaseController
{

    public function index(PaginationAPIRequest $request): JsonResponse
    {
        // $authors = Author::all();
        $authors = Author::paginate($request['per_page']);
        if (!is_null($authors) && $authors->count() > 0) {
            return $this->sendResponse($authors, "Retrieved successfully.");
        }

        return $this->sendError("No Authors Found");
    }


public function store(StoreAuthorAPIRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // if no value for is_company then set it to false
        $validated['is_company'] = $validated['is_company'] ?? 0;

        //  If given_name is not supplied, move family_name to given_name
        if (!isset($validated['given_name'])) {
            $validated['given_name'] = $validated['family_name'];
            $validated['family_name'] = null;
        }

        $authors = Author::create($validated);

        return $this->sendResponse(
            $authors,
            "Created successfully."
        );
    }

    public function show(int $id): JsonResponse
    {
        $author = Author::find($id);
        if (!(is_null($author))) {
            if ($author->count() > 0) {
                return $this->sendResponse(
                    $author,
                    "Retrieved successfully.",
                );
            }
        }

        return $this->sendError("Author Not Found");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAuthorAPIRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAuthorAPIRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $author = Author::query()->where('id', $id)->first();

        if (!is_null($author) && $author->count() > 0) {
            $validated['is_company'] = $validated['is_company'] ?? 0;

            //  If given_name is not supplied, move family_name to given_name
            if (!isset($validated['given_name'])) {
                $validated['given_name'] = $validated['family_name'];
                $validated['family_name'] = null;
            }

            $author['given_name'] = $validated['given_name'];
            $author['family_name'] = $validated['family_name'];
            $author['is_company'] = $validated['is_company'];
            $author['updated_at'] = Carbon::now();
            $author->save();

            return $this->sendResponse(
                $author,
                "Updated successfully.",
            );

        }
        return $this->sendError("Unable to update: Author Not Found");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $author = Author::query()->where('id', $id)->first();

        $destroyedAuthor = $author;

        if (!is_null($author) && $author->count() > 0) {
            $author->delete();

            return $this->sendResponse(
                $destroyedAuthor,
                "Deleted successfully.",
            );

        }
        return $this->sendError("Unable to remove: Author Not Found");
    }
}
