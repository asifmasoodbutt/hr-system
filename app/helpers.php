<?php

use App\Models\ApiRequest;
use App\Models\ErrorLog;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

if (!function_exists('saveErrorLogs')) {
    function saveErrorLogs($method_name, $line_no, $error, $status_code, $api_request_id = null)
    {
        ErrorLog::create([
            "method_name" => $method_name,
            "line_no" => $line_no,
            "error" => $error,
            "status_code" => $status_code,
            "api_request_id" => $api_request_id
        ]);
    }
}

if (!function_exists('throwException')) {
    function throwException($exception, $method_name, $api_request_id)
    {
        $fe = FlattenException::create($exception);
        saveErrorLogs($method_name, $fe->getLine(), $fe->getMessage(),  $fe->getStatusCode(), $api_request_id);
        return response()->error('Something went wrong!', 500);
    }
}

if (!function_exists('storeApiResponseData')) {
    function storeApiResponseData($api_request_id, $data, $is_success)
    {
        if ($is_success) {
            $errors = false;
            $response_data = ['errors' => $errors, 'data' => $data];
        } else {
            $errors = true;
            $response_data = ['errors' => $errors, 'message' => $data];
        }
        ApiRequest::where('id', $api_request_id)->update(['response_data' => serialize($response_data)]);
    }
}
