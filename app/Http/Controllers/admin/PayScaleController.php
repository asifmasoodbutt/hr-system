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
            $message = 'No pay scales found!';
            if ($pay_scales->isNotEmpty()) {
                $message = 'Pay scales fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($pay_scales, $message);
            }
            storeApiResponseData($request->api_request_id, $message, 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getPayScales', $request->api_request_id);
        }
    }
}
