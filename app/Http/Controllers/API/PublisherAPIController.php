<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\PaginationAPIRequest;
use App\Http\Requests\StorePublisherAPIRequest;
use App\Http\Requests\UpdatePublisherAPIRequest;
use App\Models\Country;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class PublisherAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginationAPIRequest $request): JsonResponse
    {
        $publishers = Publisher::with('country')->paginate($request['per_page']);

        if (!is_null($publishers) && $publishers->count() > 0) {
            // Modify the response data to include the country name as "Country"
            $responseData = $publishers->map(function ($publisher) {
                return [
                    'id' => $publisher->id,
                    'name' => $publisher->name,
                    'city' => $publisher->city,
                    'country' => $publisher->country->name ?? null, // Country name as "Country"
                    'created_at' => $publisher->created_at,
                    'updated_at' => $publisher->updated_at,
                ];
            });

            return $this->sendResponse($responseData, "Retrieved successfully.");
        }

        return $this->sendError("No Publishers Found");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherAPIRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // check if country_code supplied
        if (isset($validated['country_code'])) {
            // Check if country_code exists, if not, ignore
            $country = Country::where('code_3', $validated['country_code'])->first();
        } else {
            $country = null;
        }

        $newPublisher = [
            'name' => $validated['name'],
            'city' => $validated['city'] ?? null, // Use null if no value present
            'country_id' => $country->id ?? null,
        ];

        $publisher = Publisher::create($newPublisher);
        // Eager load the 'country' relationship to fetch the country data
        $publisher->load('country'); // could have used $country but this proves publisher has correct country

        $responseData = [
            'id' => $publisher->id,
            'name' => $publisher->name,
            'city' => $publisher->city,
            'country' => $publisher->country->name ?? null,
            'created_at' => $publisher->created_at,
            'updated_at' => $publisher->updated_at,
        ];
        return response()->json(
            [
                'success' => true,
                'message' => "Created successfully.",
                'data' => [
                    'publisher' => $responseData,
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
        $publisher = Publisher::with('country')->find($id);

        if (!is_null($publisher)) {
            $responseData = [
                'id' => $publisher->id,
                'name' => $publisher->name,
                'city' => $publisher->city,
                'country' => $publisher->country->name ?? null,
                'created_at' => $publisher->created_at,
                'updated_at' => $publisher->updated_at,
            ];

            return $this->sendResponse($responseData, "Retrieved successfully.");
        }

        return $this->sendError("User Not Found");
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdatePublisherAPIRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $publisher = Publisher::query()->where('id', $id)->first();

        if (!is_null($publisher) && $publisher->count() > 0) {
            if (!is_null($validated['country_code'])) {
                // Check if country_code exists, if not, ignore
                $country = Country::where('code_3', $validated['country_code'])->first();
            } else {
                $country = null;
            }
            $publisher['name'] = $validated['name'];
            $publisher['city'] = $validated['city'];
            $publisher['country_id'] = $country->id ?? null;
            $publisher['updated_at'] = Carbon::now();
            $publisher->save();

            $responseData = [
                'id' => $publisher->id,
                'name' => $publisher->name,
                'city' => $publisher->city,
                'country' => $publisher->country->name ?? null,
                'created_at' => $publisher->created_at,
                'updated_at' => $publisher->updated_at,
            ];

            return response()->json(
                [
                    'status' => true,
                    'message' => "Updated successfully.",
                    'publisher' => $responseData
                ],
                200  # Ok
            );
        }
        return response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Publisher Not Found",
                'publishers' => null
            ],
            404  # Not Found
        );

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(UpdatePublisherAPIRequest $request, string $id): JsonResponse
    {
        $publisher = Publisher::query()->where('id', $id)->first();
        $destroyedPublisher = $publisher;

        if (!is_null($publisher) && $publisher->count() > 0) {
            $publisher->delete();

            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Publisher Deleted.",
                    'publisher' => $destroyedPublisher
                ],
                200  # Ok
            );
            return $response;

        }
        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Publisher Not Found",
                'publishers' => null
            ],
            404  # Not Found
        );
        return $response;
    }
}
