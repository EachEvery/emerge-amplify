<?php

use App\Repositories\CollectionRepository;

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
Route::get('/poems', 'PoemController@index');
Route::post('/poems', 'PoemController@store');
Route::get('/poems/{poem_id}', 'PoemController@show');

Route::post('/messages', 'MessageController@store');

Route::get('/', 'PortalController')->name('portal');

Route::redirect('/admin', '/admin/login');

Route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/random', function (CollectionRepository $collections) {
    $collection = $collections->random();

    return redirect(route('collection', compact('collection')));
});

Route::get('/{collection}', 'CollectionController')->name('collection');
