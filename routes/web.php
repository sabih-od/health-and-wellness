<?php

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
    return view('front.index');
})->name('front.home');

Route::get('/login', function () {
    return view('front.login');
})->name('front.login');

Route::get('/signup', function () {
    return view('front.signup');
})->name('front.signup');

Route::get('/about', function () {
    return view('front.about');
})->name('front.about');

Route::get('/contact', function () {
    return view('front.contact');
})->name('front.contact');

Route::get('/education', function () {
    return view('front.education');
})->name('front.education');

Route::get('/faq', function () {
    return view('front.faq');
})->name('front.faq');

Route::get('/gift-card', function () {
    return view('front.gift-card');
})->name('front.gift-card');

Route::get('/health', function () {
    return view('front.health');
})->name('front.health');

Route::get('/membership', function () {
    return view('front.membership');
})->name('front.membership');

Route::get('/services', function () {
    return view('front.services');
})->name('front.services');
