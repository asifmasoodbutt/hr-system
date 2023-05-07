<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PayScale;
use Illuminate\Http\Request;

class PayScaleController extends Controller
{
    public function getPayScales(Request $request)
    {
        try {
            $pay_scales = PayScale::get();
            if ($pay_scales->isNotEmpty()) {
                storeApiResponseData($request->api_request_id, $pay_scales, 200, true);
                return response()->success($pay_scales);
            }
            storeApiResponseData($request->api_request_id, 'No pay scales found!', 404, false);
            return response()->error('No pay scales found!', 404);
        } catch (\Exception $e) {
            return throwException($e, 'getPayScales', $request->api_request_id);
        }
    }
}
