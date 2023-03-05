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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function() {
  /** Yarn **/
  Route::get('/yarn', function () {
    return view('yarn.index');
  })->name('yarn');
  Route::get('/yarn/search_yarn_form', 'YarnController@search_yarn_form')->name('yarn.search_yarn_form');
  Route::post('/yarn/search_yarn', 'YarnController@search_yarn')->name('yarn.search_yarn');
  Route::get('/yarn/search_brand', 'YarnController@search_brand')->name('yarn.search_brand');

  Route::get('/yarn/add_brand', 'YarnController@add_brand')->name('yarn.add_brand');
  Route::post('/yarn/brand_store', 'YarnController@brand_store')->name('yarn.brand_store');

  Route::get('/yarn/add_fibre', 'YarnController@add_fibre')->name('yarn.add_fibre');
  Route::post('/yarn/store_fibre', 'YarnController@store_fibre')->name('yarn.store_fibre');

  Route::get('/yarn/add_yarn_name', 'YarnController@add_yarn_name')->name('yarn.add_yarn_name');
  Route::post('/yarn/store_yarn_name', 'YarnController@store_yarn_name')->name('yarn.store_yarn_name');

  Route::get('/yarn/{brand_id}/add_yarn', 'YarnController@add_yarn')->name('yarn.add_yarn');
  Route::post('/yarn/store_yarn', 'YarnController@store_yarn')->name('yarn.store_yarn');

  Route::get('/yarn/{yarn_id}/edit', 'YarnController@edit')->name('yarn.edit_yarn');
  Route::put('/yarn/{yarn_id}/update', 'YarnController@update')->name('yarn.update_yarn');

  Route::get('yarn/list_all_yarn', 'YarnController@list_all_yarn')->name('yarn.list_all_yarn');
  route::get('yarn/{yarn_id}/details', 'YarnController@details')->name('yarn.details');
  /** Stash routes **/
});
