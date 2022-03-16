<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;
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

// auth routes
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])
        ->name('auth.login.form');
    Route::post('login', [AuthController::class, 'login'])
        ->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::get('register', [AuthController::class, 'registerForm'])
        ->name('auth.register.form');
    Route::post('register', [AuthController::class, 'register'])
        ->name('auth.register');
});

Route::get('topics/show/{topic}', [TopicController::class, 'show'])
    ->name('topics.show');
// medical topics
Route::middleware(['auth'])->prefix('topics')->group(function () {
    Route::get('delete/{topic}', [TopicController::class, 'delete'])
        ->middleware('can:delete_topic')
        ->name('topics.delete');
    Route::get('create', [TopicController::class, 'createForm'])
        ->middleware('can:create_topic')
        ->name('topics.create.form');
    Route::get('{topic}/edit', [TopicController::class, 'editForm'])
        ->middleware('can:update_topic')
        ->name('topics.edit.form');
    Route::post('{topic}/edit', [TopicController::class, 'update'])
        ->middleware('can:update_topic')
        ->name('topics.edit');
    Route::post('', [TopicController::class, 'create'])
        ->middleware('can:create_topic')
        ->name('topics.create');
    Route::get('', [TopicController::class, 'index'])
        ->middleware('can:show_topic')
        ->name('topics.index');
    Route::get('', [TopicController::class, 'index'])
        ->middleware('can:show_topic')
        ->name('topics.index');
    Route::get('', [TopicController::class, 'index'])
        ->middleware('can:show_topic')
        ->name('topics.index');
});

// categories
Route::middleware(['auth'])->prefix('categories')->group(function() {
    Route::get('delete/{category}', [CategoryController::class, 'delete'])
        ->middleware('can:delete_category')
        ->name('categories.delete');
    Route::get('create', [CategoryController::class, 'createForm'])
        ->middleware('can:create_category')
        ->name('categories.create.form');
    Route::post('', [CategoryController::class, 'create'])
        ->middleware('can:create_category')
        ->name('categories.create');
    Route::get('', [CategoryController::class, 'index'])
        ->middleware('can:show_category')
        ->name('categories.index');
});

// consulting requests
Route::middleware(['auth'])->prefix('consulting-requests')->group(function () {
    Route::post('reply', [ConsultRequestController::class, 'consult'])
        ->middleware('role:admin');
    Route::get('my-requests', [ConsultRequestController::class, 'myRequests'])
        ->name('requests.my-requests');
    Route::get('show/{request}', [ConsultRequestController::class, 'show'])
        ->name('requests.show');
    Route::get('consult', [ConsultRequestController::class, 'consultForm'])
        ->name('requests.create.form');
    Route::post('reply/{consultRequest}', [ConsultRequestController::class, 'reply'])
        ->middleware('role:admin')
        ->name('requests.reply');
    Route::get('reply/{consultRequest}', [ConsultRequestController::class, 'replyForm'])
        ->middleware('role:admin')
        ->name('requests.reply.form');
    Route::get('', [ConsultRequestController::class, 'index'])
        ->middleware('role:admin')
        ->name('requests.index');
    Route::post('', [ConsultRequestController::class, 'consult'])
        ->name('requests.create');
});

// home
Route::get('', [HomeController::class, 'home'])
    ->name('home');
