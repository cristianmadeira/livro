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


Auth::routes();
Route::group(array("middleware"=>"auth"),function(){
  Route::get("/books/mybooks","BookController@myBooks")->name("books.mybooks.index");
  Route::post("/books/mybooks/{book}","BookController@setBookReadedOrDesired")->name("books.mybooks.create");
  Route::delete("/books/mybooks/{id}","BookController@destroyMyBooks")->name("books.mybooks.destroy");
  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource("/books","BookController");
  Route::resource("users","UserController");
  Route::resource("profiles","ProfileController");
});

Route::get('/', function () {
    return view('welcome');
});
