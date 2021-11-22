<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/external-cmd', function() {
//     Artisan::call('migrate:refresh');
//     Artisan::call('db:seed');
//     Artisan::call('optimize:clear');
//     return "Cache is cleared";
// });
Route::get('/migrate-table-results', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_08_16_042346_create_results_table.php');
    return "Results table is created";
});
Route::get('/migrate-table-information', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_08_17_082850_create_information_table.php');
    return "Informations table is created";
});
Route::get('/migrate-table-score', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_08_18_123539_create_scores_table.php');
    return "Score table is created";
});
Route::get('/migrate-table-user', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2014_10_12_000000_create_users_table.php');
    return "User table is created";
});
Route::get('/migrate-table-login-track', function(){
    Artisan::call('migrate:refresh --path=/database/migrations/2021_09_16_045446_create_logintracks_table.php');
    return "Login table is created";
});
Route::get('/migrate-all', function(){
    Artisan::call('migrate:refresh');
    return "Cache is cleared";
});