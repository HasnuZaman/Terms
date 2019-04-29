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

Route::get('/', 'PagesController@index')->name('dashboard');
Route::get('/about', 'PagesController@about');

Route::resource('terms', 'TermsController');
Route::get('/approve/{id}', 'TermsController@approve');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pending-agreements', 'TermsController@pendingList')->name('pendingAgreement');
