<?php

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
    function throwException($exception, $api_request_id)
    {
        $fe = FlattenException::create($exception);
        saveErrorLogs('loginApi', $fe->getLine(), $fe->getMessage(),  $fe->getStatusCode(), $api_request_id);
        return response()->error('Something went wrong!', 500);
    }
}
