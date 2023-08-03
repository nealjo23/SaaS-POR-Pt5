<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiFallbackController extends ApiBaseController
{


    public function error(Request $request): JsonResponse
    {
        return $this->sendError("Page Not Found. If error persists, contact help@tafe.wa.edu.au");
    }
}
