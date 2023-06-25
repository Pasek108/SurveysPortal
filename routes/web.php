<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use App\Models\Survey;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
Route::controller(SurveyController::class)->group(function () {
    Route::get ('/',                          'top6');
    Route::get ('/survey/search',             'search');
    Route::get ('/survey/create',             'create')->middleware('auth');
    Route::post('/survey/store',              'store')->middleware('auth');
    Route::get ('/survey/{survey:id}/fill',   'fill')->where('id', '[0-9]+');
    Route::post('/survey/{survey:id}/send',   'send')->where('id', '[0-9]+');
    Route::get ('/survey/{survey:id}',        'show')->where('id', '[0-9]+')->name("survey.show");
    Route::get ('/survey/{survey:id}/edit',   'edit')->where('id', '[0-9]+')->middleware('auth');
    Route::put ('/survey/{survey:id}',        'update')->where('id', '[0-9]+')->middleware('auth');
    Route::post('/survey/{survey:id}/stats',  'stats')->where('id', '[0-9]+')->middleware('auth');
});

/* ----------------------- admin panel ----------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/admin-panel',          function () { return view('admin-panel.dashboard'); });
    Route::get('/admin-panel/messages', function () { return view('admin-panel.messages'); });
    Route::get('/admin-panel/reports',  function () { return view('admin-panel.reports'); });
    Route::get('/admin-panel/contact',  function () { return view('admin-panel.contact'); });
    Route::get('/admin-panel/admins',   function () { return view('admin-panel.admins'); });
    Route::get('/admin-panel/users',    function (Request $request) {
        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'role') $sort_by = 'role_id';

        $users = User::where('name', 'LIKE', '%'.$search.'%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'users_page');

        $check_user = User::with('surveys')->find(5);
        $check_user_surveys = $check_user->surveys()->paginate(5, ['*'], 'check_user_surveys_page');

        return view('admin-panel.users', ['users' => $users, 'check_user' => $check_user, 'check_user_surveys' => $check_user_surveys]);
    });
    Route::get('/admin-panel/bans',     function () { return view('admin-panel.bans'); });
    Route::get('/admin-panel/surveys',  function (Request $request) {
        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'role') $sort_by = 'role_id';

        $surveys = Survey::where('title', 'LIKE', '%'.$search.'%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'surveys_page');

        $check_survey = Survey::with('questions')->find(21);
        $check_survey_questions = $check_survey->questions()->paginate(5, ['*'], 'check_survey_questions_page');

        return view('admin-panel.surveys', ['surveys' => $surveys, 'check_survey' => $check_survey, 'check_survey_questions' => $check_survey_questions]);
    });
    Route::get('/admin-panel/tags',     function () { return view('admin-panel.tags'); });
});

/* ----------------------- profile ----------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit',      [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit',    [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit',   [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user:id}', [ProfileController::class, 'show'])->name('profile.show')->where(['id' => '[0-9]+']);
});

/* ----------------------- password ----------------------- */
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT ?
        back()->with(['status' => __($status)]) :
        back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET ?
        redirect()->route('login')->with('status', __($status)) :
        back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

/* ----------------------- email ----------------------- */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__ . '/auth.php';
