<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\MockController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/signup', function () {
    return view('auth.signUp');
});


Route::get('/question/first', [QuestionController::class,'chooseType']);

Route::get('/question/written', [QuestionController::class,'showWrittenQuestion']);


Route::post('/user/signup', [UserController::class, 'store']);
Route::post('/login/home', [UserController::class, 'login']);

Route::get('/email/verify/{id}', 'Auth\VerificationController@show')->name('verify-email');
Route::get('/email/verify/{id}', [VerificationController::class ,'verify'])->name('verify-email');



Route::get('/st', function(){
    return view('st');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::get('/profile',[UserController::class, 'index']);

    Route::post('/edit/profile/{id}', [UserController::class, 'update']);
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/create', [SubjectController::class, 'create']);

        Route::post('/check/ans',[UserAnswerController::class, 'scoreAns']);

        Route::get('/check',[UserAnswerController::class,'check']);

        Route::post('/create', [SubjectController::class,'store']);
    
        Route::get('/createQuestion', [QuestionController::class,'create']);
        Route::post('/createQuestion', [QuestionController::class, 'store']);
    
        Route::get('/create/mock/subject', [MockController::class,'chooseSubjects']);
        Route::post('/create/mock/question', [MockController::class,'create']);
    
        Route::post('/create/mock/new',[MockController::class, 'store']);

        Route::get('/list',[MockController::class, 'adminViewMock']);

        Route::post('/create/question/written',[QuestionController::class, 'createWritten']);

    });

    Route::get('/score',function () {
        return view('mock.score');
    });
    
    Route::get('/home',[MockController::class, 'index'])->middleware('auth');

    Route::get('/mock/{id}',[MockController::class,'show']);

    Route::post('/mock/result', [MockController::class ,'checkResult']);

    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});