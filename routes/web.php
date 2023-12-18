<?php

use App\Livewire\Auth\LoginPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\FollowUp\Components\FormSpk;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', LoginPage::class)->name('login');
Route::post('/logout', [LoginIndex::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'follow-up', 'middleware' => ['user-access:Follow Up']], function () {
        Route::get('/form-spk', FormSpk::class)->name('dashboard.FollowUp');
    });
});

