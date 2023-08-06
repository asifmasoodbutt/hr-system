<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DegreeLevel;
use Illuminate\Http\Request;

class DegreeLevelController extends Controller
{
    public function getDegreeLevels(Request $request)
    {
        try {
            $degree_levels = DegreeLevel::get();
            $message = 'No degree levels found!';
            if ($degree_levels->isNotEmpty()) {
                $message = 'Degree levels fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($degree_levels, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getDegreeLevels', $request->api_request_id);
        }
    }
}
