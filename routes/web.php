<?php

use Illuminate\Support\Facades\Route;
use App\Models\Language;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\TokenAuth;

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

Route::view('/register','register')->name('register.index');
Route::view('/login', 'login')->name('login.index');

Route::post('check-email', [UserController::class, 'checkEmailAvailability'])->name('check-email');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware([TokenAuth::class])->group(function () {
    Route::get('/', function () {
        $languages = Language::all();

        if(empty(session('selected_language_id'))) {
            session(['selected_language_id' => 3, 'selected_language_name' => "Inglés UK", 'selected_language_flag' => "english_uk.png"]);
        }

        if(session('user_isPremium') === 1) {
            return view('language_selector', ['languages' => $languages]);
        }
        
        $languages = Language::whereIn('id', [5, 7])->get();
        return view('language_selector', ['languages' => $languages]);
    });

    Route::resource('word', WordController::class);
    Route::resource('category', CategoryController::class);
    
    Route::get('/language', [LanguageController::class, 'index'])->name('language.index');
    Route::post('/language', [LanguageController::class, 'select'])->name('language.select');
    Route::post('/word/filter', [WordController::class, 'filter'])->name('word.filter');
});
