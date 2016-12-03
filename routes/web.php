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

//main page
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Auth::routes();
Route::get('/admin' , 'Auth.LoginController@admin');

Route::get('now', function () {
    return date("Y-m-d H:i:s");
});

//blog
Route::get('/articles','ArticlesController@index');
Route::get('/articles/{id}','ArticlesController@show');

//problem
Route::get('/problems','ProblemsContreller@index');
Route::get('/problems/{id}','ProblemsContreller@show');

//statu
Route::get('/status','StatusController@index');
Route::get('/status/{id}' , 'StatusController@show_code');

//submit
Route::post('/submit','SubmitController@submit');
Route::get('/problems/{id}/submit','SubmitController@submit_page');

//rank
Route::get('/rank','RankController@index');

//Contest
Route::get('/contests' , 'ContestsController@index');
Route::get('/contests/{id}' , 'ContestsController@show');
Route::post('/contests/{id}' , 'ContestsController@show');
Route::get('/contests/{id}/{problem_tag}' , 'ContestsController@show_problem');
Route::post('/contests/{id}/{problem_tag}' , 'ContestsController@show_problem');
Route::get('/contests/{id}/{problem_tag}/submit' , 'ContestsController@submit_page');
Route::post('/contests/{id}/{problem_tag}/submit' , 'ContestsController@submit_page');
Route::post('/contest/submit','ContestsController@submit');
Route::get('/contests/{id}/status/now' , 'ContestsController@status');
Route::post('/contests/{id}/status/now' , 'ContestsController@status');
Route::get('/contests/{id}/rank/now' , 'ContestsController@rank');
Route::post('/contests/{id}/rank/now' , 'ContestsController@rank');

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
