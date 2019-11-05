<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Xcategories
    Route::apiResource('xcategories', 'XcategoriesApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Testposts
    Route::apiResource('testposts', 'TestpostsApiController');

    // Testmodules
    Route::post('testmodules/media', 'TestmoduleApiController@storeMedia')->name('testmodules.storeMedia');
    Route::apiResource('testmodules', 'TestmoduleApiController');
});
