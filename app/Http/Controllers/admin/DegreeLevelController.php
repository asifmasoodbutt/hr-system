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
            if ($degree_levels->isNotEmpty()) {
                storeApiResponseData($request->api_request_id, $degree_levels, 200, true);
                return response()->success($degree_levels);
            }
            storeApiResponseData($request->api_request_id, 'No degree levels found!', 404, false);
            return response()->error('No degree levels found!', 404);
        } catch (\Exception $e) {
            return throwException($e, 'getDegreeLevels', $request->api_request_id);
        }
    }
}
