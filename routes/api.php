<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Questions
    Route::apiResource('questions', 'QuestionsApiController');

    // Options
    Route::apiResource('options', 'OptionsApiController');

    // Results
    Route::apiResource('results', 'ResultsApiController');
});
