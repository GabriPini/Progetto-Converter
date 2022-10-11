<?php

use App\Http\Controllers\ConverterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', function () {
    return view('home');
});


Route::get('/home', 'HomeController@index')->name('home');




/* Probabile route sbagliata  ricevo messaggio :"The GET method is not supported for this route. Supported methods: POST." */


/* Route::get("{any?}", function(){
    return view("home");
})->where("any",".*");

 */
