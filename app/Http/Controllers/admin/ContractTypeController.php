<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContractType;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function getContractTypes(Request $request)
    {
        try {
            $contract_types = ContractType::get();
            $message = 'No contract types found!';
            if ($contract_types->isNotEmpty()) {
                $message = 'Contract types fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($contract_types, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 404, false);
            return response()->error($message, 404);
        } catch (\Exception $e) {
            return throwException($e, 'getContractTypes', $request->api_request_id);
        }
    }
}
