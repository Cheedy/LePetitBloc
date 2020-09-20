<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () 
{
    return view('welcome');
});

Route::get('/welcome','HomeController@index')->name('welcome');

Auth::routes();

Route::get('/tasksList/{search?}', 'TaskController@index'); // Route pour faire une recherche sur les tâches

Route::post('/tasksList', 'TaskController@store');  // Route pour ajouter une tâche

Route::get('/tasks/edit/{id}', 'TaskController@edit'); // Route pour récuperer la donnée à  modifier

Route::get('/user', 'TaskController@GetUserId'); // Route pour récuperer la donnée à  modifier

Route::patch('/tasks/edit/{id}', 'TaskController@update'); // Route pour confirmer la modification de la donnée

Route::delete('/tasks/{id}', 'TaskController@destroy'); // Route pour supprimer la tâche selectionnée

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
