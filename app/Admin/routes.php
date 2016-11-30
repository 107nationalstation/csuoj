<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('problems', ProblemController::class);
    $router->resource('articles', ArticleController::class);
    $router->resource('contests', ContestController::class);
    $router->resource('addproblems', AddProblemToContestController::class);
});
