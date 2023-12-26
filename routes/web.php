<?php

use App\Livewire\Auth\LoginPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\FollowUp\Components\AllTask;
use App\Livewire\FollowUp\Components\FormSpk;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Penjadwalan\Components\TimelineTask;
use App\Livewire\HitungBahan\Components\FormHitungBahan;
use App\Livewire\FollowUp\Components\Dashboard as DashboardFollowup;
use App\Livewire\HitungBahan\Components\Dashboard as DashboardHitungBahan;
use App\Livewire\Penjadwalan\Components\Dashboard as DashboardPenjadwalan;
use App\Livewire\Stock\Components\Dashboard as DashboardStock;

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
        Route::get('/dashboard', DashboardFollowup::class)->name('dashboard.FollowUp');
        Route::get('/form-spk/{state}', FormSpk::class)->name('formSpk.FollowUp');
        Route::get('/all-task', AllTask::class)->name('allTask.FollowUp');
    });
    Route::group(['prefix' => 'stock', 'middleware' => ['user-access:Stock']], function () {
        Route::get('/dashboard', DashboardStock::class)->name('dashboard.Stock');
    });
    Route::group(['prefix' => 'penjadwalan', 'middleware' => ['user-access:Penjadwalan']], function () {
        Route::get('/dashboard', DashboardPenjadwalan::class)->name('dashboard.Penjadwalan');
        Route::get('/timeline-task', TimelineTask::class)->name('timelineTask.Penjadwalan');
    });
    Route::group(['prefix' => 'hitung-bahan', 'middleware' => ['user-access:Hitung Bahan']], function () {
        Route::get('/dashboard', DashboardHitungBahan::class)->name('dashboard.HitungBahan');
        Route::get('/form-hitung-bahan/{id}', FormHitungBahan::class)->name('timelineTask.HitungBahan');
    });
});

