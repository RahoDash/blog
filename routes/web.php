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

	// $articles = DB::table('articles')
 //            ->leftJoin('images', 'articles.id', '=', 'images.article_id')
 //            ->get();

    return view('welcome')->with('articles', App\Article::all())->with('photos', App\Photo::all());
});

Route::get('addArticle', function(){
	return view('addArticle');
});

Route::post('/', 'ArticleController@create')->name('upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
