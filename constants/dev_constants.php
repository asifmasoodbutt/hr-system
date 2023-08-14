<?php


$base_url = "http://127.0.0.1:8000/";

$dev_constants = [
    // ENDPOINTS
    'LOGIN_ENDPOINT' => $base_url . 'api/auth/login',
    'FORGOT_PASSWORD_ENDPOINT' => $base_url . 'api/auth/send-reset-link-mail',
    'RESET_PASSWORD_ENDPOINT' => $base_url . 'api/auth/reset-password',
    'LOGOUT_ENDPOINT' => $base_url . 'api/auth/logout',
    'GET_DEPARTMENTS_ENDPOINT' => $base_url . 'api/get-departments',
    'GET_DEGREE_LEVELS_ENDPOINT' => $base_url . 'api/get-degree_levels',
    'GET_PAY_SCALES_ENDPOINT' => $base_url . 'api/get-pay-scales',
    'GET_CONTRACT_TYPES_ENDPOINT' => $base_url . 'api/get-contract-types',
    'REGISTER_EMPLOYEE_ENDPOINT' => $base_url . 'api/register-employee',
    'GET_EMPLOYEES_ENDPOINT' => $base_url . 'api/get-employees',
    'SHOW_EMPLOYEE_DETAILS_PAGE' => $base_url . 'employee-details',
    'GET_PROFILE_DETAILS_ENDPOINT' => $base_url . 'api/get-profile-details',
    'CHANGE_PASSWORD_ENDPOINT' => $base_url . 'api/change-password',
    'GET_DASHBOARD_DATA_ENDPOINT' => $base_url . 'api/get-dashboard-data',
    'GET_EMPLOYEE_DETAILS_ENDPOINT' => $base_url . 'api/get-employee-details',
    'GET_ROLES_ENDPOINT' => $base_url . 'api/get-roles',
    'CREATE_ROLE_ENDPOINT' => $base_url . 'api/create-role',
    'DELETE_ROLE_ENDPOINT' => $base_url . 'api/delete-role',
    'EDIT_ROLE_ENDPOINT' => $base_url . 'api/edit-role',
    'GET_ROLE_WITH_PERMISSIONS_ENDPOINT' => $base_url . 'api/get-role-with-permissions',
    'GET_PERMISSIONS_ENDPOINT' => $base_url . 'api/get-permissions',
    'CREATE_PERMISSION_ENDPOINT' => $base_url . 'api/create-permission',
    'DELETE_PERMISSION_ENDPOINT' => $base_url . 'api/delete-permission',
    'EDIT_PERMISSION_ENDPOINT' => $base_url . 'api/edit-permission',
    'GET_PERMISSION_WITH_ROLES_ENDPOINT' => $base_url . 'api/get-permission-with-roles'
];