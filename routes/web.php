<?php

use App\Http\Controllers\SurveysController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Surveys;
use App\Models\Tags;

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

Route::get('/', [SurveysController::class, 'index']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/search', function (Request $request) {
    dd($request->name);
    return view('search');
});

Route::get('/survey/{survey:name}', [SurveysController::class, 'show'])->where('name', '[a-z0-9]+');
