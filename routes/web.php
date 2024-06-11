<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/addform', [NewController::class, 'addForm'])->name('addform');
Route::get('/place', [NewController::class, 'viewplace'])->name('viewplace');
Route::get('/place/add', [NewController::class, 'addplace'])->name('addplace');
Route::match(['get', 'post'], '/place/update/{id}', [NewController::class, 'updateplace'])->name('updateplace');
Route::get('/delete-place/{id}', [NewController::class, 'deleteplace'])->name('deleteplace');

Route::post('/addformpos', [NewController::class, 'addFormpos'])->name('addformpos');
Route::get('/position', [NewController::class, 'viewposition'])->name('viewposition');
Route::get('/position/add', [NewController::class, 'addposition'])->name('addposition');
Route::match(['get', 'post'], '/position/update/{id}', [NewController::class, 'updateposition'])->name('updateposition');
Route::get('/delete-position/{id}', [NewController::class, 'deleteposition'])->name('deleteposition');

Route::post('/addformemployee', [NewController::class, 'addFormemployee'])->name('addformemployee');
Route::get('/employee', [NewController::class, 'viewemployee'])->name('viewemployee');
Route::get('/employee/add', [NewController::class, 'addemployee'])->name('addemployee');
Route::match(['get', 'post'], '/employee/update/{id}', [NewController::class, 'updateemployee'])->name('updateemployee');
Route::get('/delete-employee/{id}', [NewController::class, 'deleteemployee'])->name('deleteemployee');