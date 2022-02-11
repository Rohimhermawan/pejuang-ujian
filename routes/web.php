<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;

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
Route::get('/features', [FeatureController::class, 'index']);
Route::get('/features/blog/{slug}', [FeatureController::class, 'viewBlog']);
Route::get('/features/exam/{slug}', [FeatureController::class, 'viewExam']);
Route::get('/features/fetchquestion/{id}', [FeatureController::class, 'fetchQuestion']);

Route::get('/admin/dashboard', function() {return view('admin.dashboard');});
Route::get('/admin/post/createSlug', [PostController::class, 'createSlug']);
Route::get('/admin/exam/createSlug', [ExamController::class, 'createSlug']);
Route::resource('/admin/posts', PostController::class);
Route::resource('/admin/exams', ExamController::class);
Route::resource('/admin/questions', QuestionController::class);