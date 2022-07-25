<?php

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

Route::get('/kontakt/{country?}', [TestController::class, 'kontakt'])->name('kontaktFormular');

Route::post('/kontakt', [TestController::class, 'send'])->name('sendFormular');

Route::prefix('/post')->name('post.')->controller(TestController::class)->group(function () {

    Route::get('/', 'index')->name('list');
    Route::get('/edit', 'test')->name('edit');
    Route::get('/show', 'test2')->name('show');

});
