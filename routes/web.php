<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* ----------------------- surveys ----------------------- */
Route::get('/', [SurveyController::class, 'top6']);
Route::get('/survey/{survey:name}', [SurveyController::class, 'show'])->where('name', '[a-z0-9]+');
Route::get('/search', [SurveyController::class, 'search']);
Route::get('/create-survey', [SurveyController::class, 'create'])->middleware('auth');;

/* ----------------------- users ----------------------- */
Route::get('/users/{user:name}', [UserController::class, 'show']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth', [UserController::class, 'auth']);
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);

/* ----------------------- admin panel ----------------------- */
Route::get('/admin-panel', function () {
    return view('pages.admin-panel.dashboard');
})->middleware('auth');

Route::get('/admin-panel/messages', function () {
    return view('pages.admin-panel.messages');
})->middleware('auth');

Route::get('/admin-panel/reports', function () {
    return view('pages.admin-panel.reports');
})->middleware('auth');

Route::get('/admin-panel/contact', function () {
    return view('pages.admin-panel.contact');
})->middleware('auth');

Route::get('/admin-panel/admins', function () {
    return view('pages.admin-panel.admins');
})->middleware('auth');

Route::get('/admin-panel/users', function () {
    return view('pages.admin-panel.users');
})->middleware('auth');

Route::get('/admin-panel/bans', function () {
    return view('pages.admin-panel.bans');
})->middleware('auth');

Route::get('/admin-panel/surveys', function () {
    return view('pages.admin-panel.surveys');
})->middleware('auth');

Route::get('/admin-panel/tags', function () {
    return view('pages.admin-panel.tags');
})->middleware('auth');


