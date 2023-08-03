<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationAPIRequest;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginationAPIRequest $request): JsonResponse
    {
        $countries = Country::with('publishers')->paginate($request['per_page']);

        if (!is_null($countries) && $countries->count() > 0) {
            return $this->sendResponse($countries, "Retrieved successfully.");
        }

        return $this->sendError("No Genres Found");
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
    public function show(string $id)
    {
        $country = Country::with('publishers')->find($id);
        return response()->json($country);
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
