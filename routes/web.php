<?php

use App\Http\Controllers\AuthadminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChoiseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
// use App\Models\User;
use App\Models\Vote;
// use App\Models\Result;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
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
Route::get('/demo', function () {
});
Route::get('/', function () {
    $votes = Vote::orderBy('created_at','desc')->get();
    return view('platform.index',compact('votes'));
})->name('platform.index');

Route::get('admin',function(){
    return view('admin.index');
})->name('admin.index')->middleware('admin');

// Auth admin panel
Route::get('admin/login',[AuthadminController::class,'auth'])->name('admin.login');
Route::post('admin/login/process',[AuthadminController::class,'login'])->name('login.process');
Route::resource('admin/user', UserController::class)->middleware('admin');

//Auth platform
Route::resource('login', AuthController::class)->middleware('guest');
Route::resource('register', RegisterController::class)->middleware('guest');
Route::post('logout', [AuthadminController::class,'logout'])->name('logout')->middleware('auth');

Route::get('auth/redirect/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('auth/callback/{provider}', [SocialiteController::class, 'handleProviderCallback']);

// polling

Route::resource('vote', VoteController::class)->middleware('auth')->except(['show']);
Route::get('poll/{id}', [VoteController::class,'poll'])->name('vote.poll');
// Route::get('mysubjects', [VoteController::class,'mysubjects'])->name('vote.mysubjects');
Route::get('my-subjects', [VoteController::class,'getMySubjects'])->name('vote.my_subjects')->middleware('auth');

//question 
Route::resource('question', QuestionController::class);
Route::resource('choose', ChoiseController::class);



//results

Route::post('store', [ResultController::class,'store'])->name('result.store');
Route::get('show/{id}', [ResultController::class,'show'])->name('result.show')->middleware('auth');
Route::post('store-comment', [ResultController::class,'storeComment'])->name('store-comment');
Route::delete('delete-comment/{id}', [ResultController::class,'deleteComment'])->name('delete-comment');
Route::put('update-comment/{id}', [ResultController::class,'updateComment'])->name('update-comment');





// Route::get('auth/google',[SocialiteController::class,'redirectToGoogle']);
// Route::get('auth/google/callback',[SocialiteController::class,'handleGoogleCallback']);

// Route::get('auth/twitter/redirect',[SocialiteController::class,'redirectToTwitter']);
// Route::get('auth/twitter/callback',[SocialiteController::class,'handleTwitterCallback']);

Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);


Route::get('about', function(){
        return view('platform.about');
    })->name('platform.about');


Route::get('/privacy-policy',function(){
    return view('platform.privacy-policy');
});
Route::get('/terms-of-service',function(){
    return view('platform.terms-of-service');
});




