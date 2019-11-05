<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Xcategories
    Route::delete('xcategories/destroy', 'XcategoriesController@massDestroy')->name('xcategories.massDestroy');
    Route::resource('xcategories', 'XcategoriesController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Testposts
    Route::delete('testposts/destroy', 'TestpostsController@massDestroy')->name('testposts.massDestroy');
    Route::resource('testposts', 'TestpostsController');

    // Testmodules
    Route::delete('testmodules/destroy', 'TestmoduleController@massDestroy')->name('testmodules.massDestroy');
    Route::post('testmodules/media', 'TestmoduleController@storeMedia')->name('testmodules.storeMedia');
    Route::resource('testmodules', 'TestmoduleController');
});
