<?php

use App\Livewire\Auth\LoginPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\FollowUp\Components\FormSpk;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\FollowUp\Components\Dashboard;

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
Route::middleware(['guest'])->group(function () {
    Route::get('/', LoginPage::class)->name('login');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'follow-up', 'middleware' => ['user-access:Follow Up']], function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard.FollowUp');
        Route::get('/form-spk', FormSpk::class)->name('formSpk.FollowUp');
    });
});

