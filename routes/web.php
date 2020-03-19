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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('membership', 'Admin\MembershipController');
Route::get('changeInfo', 'Admin\MembershipController@changeInfo')->name('changeInfo');
Route::post('checkRecruiterAjax', 'Admin\MembershipController@checkRecruiterInfo')->name('checkRecruiterInfo');

//page route
Route::get('/home', 'Pages\PageController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get(
    'changepassword',
    function () {
        return view('cauth.changepassword');
    }
)->name('changepassword');

Route::post('dochangepassword', 'Admin\MembershipController@checkPassword')->name('dochangepassword');
Route::get('sponsors', function () {
    return view('backend.chart');
})->name('sponsors');
