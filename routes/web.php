<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\ActivityController;


Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect()->route('dashboardadmin');
        } elseif ($user->role == 'user') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::middleware('auth')->group(function () {
    Route::get('dashboard/{child_id?}', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboardadmin', [DashboardController::class, 'adminIndex'])->name('dashboardadmin');
    Route::put('users/{id}', [AuthController::class, 'update'])->name('users.update');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // ✅ Tambahkan route users.index
    Route::get('users', [AuthController::class, 'index'])->name('users.index'); 
    
    Route::get('users/{id}', [AuthController::class, 'show'])->name('users.show');
    Route::get('users/{id}/edit', [AuthController::class, 'edit'])->name('users.edit');
    Route::delete('users/{id}/delete', [AuthController::class, 'destroy'])->name('users.destroy');
        
    Route::put('users/{id}', [AuthController::class, 'update'])->name('users.update');
    Route::post('children', [ChildController::class, 'store'])->name('children.store');
    Route::delete('children/{id}', [ChildController::class, 'destroy'])->name('children.destroy');

    
    Route::get('dashboardanak', [DashboardController::class, 'childIndex'])->name('dashboardanak');
    
    
    Route::match(['put', 'post'], 'children/{id}/update-status', [ChildController::class, 'updateStatus'])->name('children.updateStatus');
    
    Route::get('/children/{id}/edit-status/{type?}', [ChildController::class, 'editStatus'])
    ->name('children.editStatus');
    Route::put('/children/{id}/makan-cemilan', [ChildController::class, 'updateMakanCemilan'])
    ->name('children.update.makan-cemilan');


    Route::put('/children/{id}/update-status/{type}', [ChildController::class, 'updateStatus']);

    Route::post('/save-step/{id}/{step}', 'ChildController@saveStep')->name('saveStep');
    Route::post('/update-status-final/{id}', 'ChildController@updateStatusFinal')->name('updateStatusFinal');

    Route::get('/searchanak', [ChildController::class, 'search'])->name('children.search');
    Route::get('/searchuser', [AuthController::class, 'search'])->name('users.search');
    
    Route::get('dashboardanak/history/{id}', [ChildController::class, 'showHistory'])->name('children.history');
    Route::get('dashboardanak/info/{id}', [ChildController::class, 'showInfo'])->name('children.info');
    
    Route::post('children/{id}/download-excel', [ChildController::class, 'downloadExcel'])->name('children.downloadExcel');
    Route::put('/children/{id}', [ChildController::class, 'update'])->name('children.update');
   
});

Route::get('/success', function () {
    return view('success.success');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
