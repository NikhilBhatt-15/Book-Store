<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// admin funcs
$router->group(['prefix'=>'api/admin'],function($router){
    
    $router->post('/addcategory','BookController@addCategory');
    $router->post('/modifycategory','BookController@modifyCategory');
    $router->post('/deletecategory','BookController@deleteCategory');
    $router->get('/categories','BookController@categories');

    $router->post('/addbook','BookController@addBook');
    $router->post('/modifybook','BookController@modifyBook');
    $router->post('/deletebook','BookController@deleteBook');
    $router->get('/books','BookController@books');


});


// user login
$router->group(['prefix'=>'api/user'],function($router){
    $router->post('/login','UserAuthController@login');
    $router->post('/logout','UserAuthController@logout');
    $router->post('/register','UserAuthController@register');
    $router->post('/update','UserAuthController@update');
    $router->post('/profile','UserAuthController@profile');
    
});


// admin login
$router->group(['prefix'=>'api/admin'],function($router){
    $router->post('/login','AdminAuthController@login');
    $router->post('/logout','AdminAuthController@logout');
    $router->post('/register','AdminAuthController@register');
    $router->post('/profile','AdminAuthController@profile');
});
