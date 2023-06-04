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
})->name('home');   
Route::get('login', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');
Route::post('login', 'AuthController@DoLogin')->name('do.login');
Route::post('register', 'AuthController@DoRegister')->name('do.register');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('panel')->group(function () {
        Route::get('dashboard','PanelController@index')->name('dashboard');
        Route::prefix('user')->group(function(){
            Route::get('/','UserController@index')->name('user.index');
            Route::get('list-user', 'UserController@list')->name('user.list');
            Route::post('/edit/{id}', 'UserController@UpdateUser')->name('user.update');
            Route::get('settings','UserController@settings')->name('user.settings');
            Route::post('settings', 'UserController@update_settings')->name('user.settings.update');
        });
        Route::prefix('category')->group(function(){
            Route::get('/', 'CategoryController@index')->name('category.index');
            Route::post('/create', 'CategoryController@store')->name('category.store');
            Route::post('/update/{id}', 'CategoryController@update')->name('category.update');
             Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.destroy');
        });
        Route::prefix('course')->group(function(){
            Route::get('/', 'CourseController@index')->name('course.index');
            Route::post('/store', 'CourseController@store')->name('course.store');
            Route::get('/edit/{id}', 'CourseController@edit')->name('course.edit');
            Route::post('/update/{id}', 'CourseController@update')->name('course.update');
            Route::get('/delete/{id}', 'CourseController@destroy')->name('course.delete');
        });
        Route::prefix('module')->group(function(){
            Route::get('/{id}', 'ModuleController@index')->name('module.index');
            Route::post('/create', 'ModuleController@store')->name('module.store');
            Route::get('/edit/{id}', 'ModuleController@edit')->name('module.edit');
            Route::post('/update/{id}', 'ModuleController@update')->name('module.update');
            Route::get('/delete/{id}', 'ModuleController@delete')->name('module.delete');
        });
        Route::prefix('lesson')->group(function(){
            Route::get('/{id}', 'LessonController@index')->name('lesson.index');
            Route::post('/create', 'LessonController@store')->name('lesson.store');
            Route::get('/edit/{id}', 'LessonController@edit')->name('lesson.edit');
            Route::post('/update/{id}', 'LessonController@update')->name('lesson.update');
            Route::get('/delete/{id}', 'LessonController@delete')->name('lesson.delete');
        });
    });
    Route::prefix('learn')->group(function(){
        Route::get('/course/{id}', 'LearnController@index')->name('learn.index');
    });
});


