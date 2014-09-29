<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * Global pattern
 */
Route::pattern('id', '[0-9]+');
//Route::get('/', function()
//{
//    return View::make('index');  
//});
Route::get('/', 'IndexController@getIndex');
Route::get('paginas/{id}', 'PaginasController@getPagina');
/*
 * Ejemplo de llamada a elemento y vista
Route::get('users', function()
{
    //return 'Users!';
    //return View::make('users');
    $users = User::all();

    return View::make('users')->with('users', $users);
});
 */

/*
 * Asignacion de composer
 */
View::composer('parts.menu', 'MenuComposer');
/*
 * Asignacion de controller
 */

Route::controller('nda', 'NdaController');
Route::controller('preregistro', 'PreregistroController');
Route::controller('menus', 'MenusController');
Route::controller('roles', 'RoleController');
Route::controller('paginas', 'PaginasController');
Route::controller('index', 'IndexController');
Route::controller('users', 'UserController');
Route::controller('login', 'SessionController');
