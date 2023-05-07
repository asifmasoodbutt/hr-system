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
            if ($contract_types->isNotEmpty()) {
                storeApiResponseData($request->api_request_id, $contract_types, 200, true);
                return response()->success($contract_types);
            }
            storeApiResponseData($request->api_request_id, 'No contract types found!', 404, false);
            return response()->error('No contract types found!', 404);
        } catch (\Exception $e) {
            return throwException($e, 'getContractTypes', $request->api_request_id);
        }
    }
}
