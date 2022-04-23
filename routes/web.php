<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Models\Exam;
use App\Models\Post;

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

Route::get('/admin/dashboard', function() {
    $data = exam::all()->count();
    $data2 = exam::whereNotNull('published_at', null)->count();
    $exam = [
        "publish"=>$data2,
        "pending"=>$data-$data2,
        "total"=> $data
    ];
    $data = post::all()->count();
    $data2 = post::whereNotNull('published_at', null)->count();
    $post = [
        "publish"=>$data2,
        "pending"=>$data-$data2,
        "total"=> $data
    ];
    return view('admin.dashboard', compact('exam', 'post'));
});
Route::get('/admin/post/createSlug', [PostController::class, 'createSlug']);
Route::get('/admin/exam/createSlug', [ExamController::class, 'createSlug']);
Route::get('/admin/category/createSlug', [CategoryController::class, 'createSlug']);
Route::post('/admin/posts/publish/{post}', [PostController::class, 'publish']);
Route::resource('/admin/posts', PostController::class);
Route::post('/admin/exams/publish/{exam}', [ExamController::class, 'publish']);
Route::resource('/admin/exams', ExamController::class);
Route::resource('/admin/questions', QuestionController::class);
Route::resource('/admin/categories', CategoryController::class);
Route::resource('/admin/materials', MaterialController::class);