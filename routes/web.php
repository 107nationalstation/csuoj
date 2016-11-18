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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('home', 'HomeController@index');

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('now', function () {
    return date("Y-m-d H:i:s");
});

Route::get('/articles','ArticlesController@index');
Route::get('/articles/{id}','ArticlesController@show');

Route::get('/problems','ProblemsContreller@index');
Route::get('/problems/{id}','ProblemsContreller@show');
Route::get('/problems/{id}/submit','SubmitController@submit_page');

Route::get('/status','StatusController@index');
Route::post('/submit','SubmitController@submit');

Route::get('/rank','RankController@index');

Route::get('/testPost',function(){
    $csrf_token = csrf_token();
    $form = <<<FORM
        <form action="/hello" method="POST">
            <input type="hidden" name="_token" value="{$csrf_token}">
            <input type="submit" value="Test"/>
        </form>
FORM;
    return $form;
});

Route::post('/hello',function(){
    return "Hello Laravel[POST]!";
});
