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


    // Obviously you'd do this in blade :)

   return view('welcome',compact('faceurl'));
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('handlegithub', 'GithubController@handleGithub');
Route::post('githubpostgists', 'GithubController@githubPostGists')->middleware('web');
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

