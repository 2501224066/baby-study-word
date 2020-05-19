<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/api/{class}/list', 'IndexController@list'); // 获取列表
$router->get('/api/{class}/detail/{id}', 'IndexController@detail'); // 获取详情
$router->get('/api/word/detail', 'IndexController@wordDetail'); //获取文字详情
