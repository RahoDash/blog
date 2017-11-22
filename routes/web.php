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
    return view('welcome')->with('articles', App\Article::all())->with('photos', App\Photo::all());
});

Route::delete('/photo/{id}', 'PhotoController@destroy');
Route::delete('/{id}', 'ArticleController@destroy');

Route::post('/', 'ArticleController@create')->name('upload');
Route::post('/addPicture{article_id}', 'PhotoController@addPicture');

Route::post('/desc{id}', 'ArticleController@updateDesc');

Route::get('/edit_image', function (){
   return view('edit_image');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
