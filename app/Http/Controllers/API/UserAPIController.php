<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PaginationAPIRequest;
use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Js;
use Psy\Util\Json;
use function PHPUnit\Framework\isNull;
use App\Models\User;

class UserAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginationAPIRequest $request): JsonResponse
    {
        $users = User::paginate($request['per_page']);

        if (!is_null($users) && $users->count() > 0) {
            return $this->sendResponse(
                $users,
                "Retrieved successfully.",
            );
        }

        return $this->sendError("No Users Found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
//        $user = User::find($id)->first();
        $user = User::find($id);

        if (isset($user) && $user->count() > 0) {
            return $this->sendResponse(
                $user,
                "Retrieved successfully.",
            );
        }

        return $this->sendError("User Not Found");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
