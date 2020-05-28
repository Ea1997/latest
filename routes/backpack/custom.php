<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('categories', 'CategoriesCrudController');
    Route::crud('items', 'ItemsCrudController');
    Route::crud('orders', 'OrdersCrudController');
    Route::crud('posts', 'PostsCrudController');
    Route::crud('users', 'UsersCrudController');


    Route::get('charts/users', 'Charts\LatestUsersChartController@response');
    // Route::get('charts/users', '\App\Charts\LatestUsersChart@data');
    //  Route::get('users', '\App\Charts\WeeklyUsersChart@data');
    //  Route::get('dashboard', 'DashboardController@overview');
    //Route::get('charts/WeeklyUsers', 'Charts\WeeklyUsersChartController@response');//->name('charts.'.weekly-users.'.admin');
    Route::get('charts/users', 'Charts\WeeklyordersChartController@response');
    Route::get('charts/new-entries', 'Charts\NewEntriesChartController@response');
    Route::get('charts/weekly-users', 'Charts\WeeklyUsersChartController@response');
   // Route::crud('bbb', 'BbbCrudController');
}); // this should be the absolute last line of this file
