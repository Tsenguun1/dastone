<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/place', [NewController::class, 'viewPlaces'])->name('viewplace');
Route::post('/addform', [NewController::class, 'addForm'])->name('addform');
Route::delete('/delete-place/{id}', [NewController::class, 'deleteplace'])->name('deleteplace');
Route::post('/updateplace', [NewController::class, 'updateplace'])->name('updateplace');


Route::post('/addformpos', [NewController::class, 'addFormpos'])->name('addformpos');
Route::get('/position', [NewController::class, 'viewposition'])->name('viewposition');
Route::post('/updateposition', [NewController::class, 'updateposition'])->name('updateposition');
Route::get('/delete-position/{id}', [NewController::class, 'deleteposition'])->name('deleteposition');

Route::post('/addformemployee', [NewController::class, 'addFormemployee'])->name('addformemployee');
Route::get('/employee', [NewController::class, 'viewemployee'])->name('viewemployee');
Route::post('/updateemployee', [NewController::class, 'updateemployee'])->name('updateemployee');
Route::get('/delete-employee/{id}', [NewController::class, 'deleteemployee'])->name('deleteemployee');