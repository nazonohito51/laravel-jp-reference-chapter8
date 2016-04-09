<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

\Route::controller('auth', 'Auth\AuthController',
    [
        'postLogin' => 'post.login',
        'getLogin' => 'get.login',
        'getRegister' => 'get.register',
        'postRegister' => 'post.register',
        'getLogout'    => 'logout'
    ]
);

\Route::group(['middleware' => 'auth'], function() {
    \Route::resource(
        'admin/entry',
        'Admin\EntryController',
        ['except' => ['destroy', 'show']]
    );
});

get('/', 'ApplicationController@index');
\Route::resource('entry', 'EntryController', ['only' => ['index', 'show']]);
\Route::resource('comment', 'CommentController', ['only' => ['store']]);
