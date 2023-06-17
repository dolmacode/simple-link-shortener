<?php

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

Route::get('/', function () {
    $recent = \App\Models\Link::orderBy('created_at', 'desc')->take(10)->get();
    
    return view('home', ['recent' => $recent]);
});

Route::get('/{short_link}', [\App\Http\Controllers\LinkController::class, 'handle']);