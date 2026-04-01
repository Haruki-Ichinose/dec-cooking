<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FamilyController;

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

// イベント登録処理
Route::post('/schedule-add', [ScheduleController::class, 'scheduleAdd'])->name('schedule-add');

// イベント取得処理
Route::post('/schedule-get', [ScheduleController::class, 'scheduleGet'])->name('schedule-get');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/dashboard', function () {
    return view('family');
})->name('dashboard');

Route::get('/create_family', function () {
    return view('create_family');
})->name('create_family');

Route::post('/family/create', [FamilyController::class, 'create_family'])->name('family.create');

Route::match(['get','post'], '/participate_family', [FamilyController::class, 'participate'])->name('participate_family');

Route::get('/paticipate', function() {
    return view('participate_family');
})->name('participate');

Route::get('/home', [FamilyController::class, 'showFamilyMembers'])->name('home');

Route::get('/profile/calendar', [ProfileController::class, 'calendar'])->name('profile.calendar');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');

require __DIR__ . '/auth.php';
