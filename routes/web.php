<?php

use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth'])->group(function () {
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('student_list', 'StudentController@list')->name('student.list');
    Route::get('batch/assign/{id}', 'BatchController@assign')->name('batch.assign');
    Route::post('batch/assign_add', 'BatchController@add_assign');

    /* Reports */
    Route::match(['get', 'post'], 'report', 'BatchController@reports')->name('reports');
    Route::get('report/student_batch/{batch_id}', 'BatchController@student_by_batch');

    Route::resource('student', 'StudentController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('subject', 'SubjectController');
    Route::resource('batch', 'BatchController');
});
