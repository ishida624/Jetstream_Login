<?php

use App\Http\Controllers\Login;
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
Route::post('login', [Login::class, 'authenticate']);
Route::get('oauthAgree', [Login::class, 'oauthAgree'])->name('oauthAgree');
Route::get('oauthLogin', [Login::class, 'oauthLogin']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
