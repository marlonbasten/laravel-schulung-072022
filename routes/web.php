<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
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

Route::get('/', [TestController::class, 'index'])->name('index');

Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/test2', [TestController::class, 'test2'])->name('test2');


Route::get('/kontakt/{country?}', [TestController::class, 'kontakt'])->name('kontaktFormular');

Route::post('/kontakt', [TestController::class, 'send'])->name('sendFormular');

Route::prefix('/post')->name('post.')->controller(TestController::class)->group(function () {

    Route::get('/', 'index')->name('list');
    Route::get('/edit', 'test')->name('edit');
    Route::get('/show', 'test2')->name('show');

});

Route::prefix('/admin')->name('admin.')->middleware('can:view-contact-requests')->group(function () {

    Route::get('/contact', [AdminController::class, 'contact'])->name('contact');
    Route::get('/contact/{contact_request}/done', [AdminController::class, 'contactDone'])->name('contactDone');
    Route::delete('/contact/{contact_request}', [AdminController::class, 'contactDelete'])->name('contactDelete');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
