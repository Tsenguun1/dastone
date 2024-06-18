<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/place', [PlaceController::class, 'viewPlaces'])->name('viewplace');
Route::post('/addform', [PlaceController::class, 'addForm'])->name('addform');
Route::delete('/delete-place/{id}', [PlaceController::class, 'deleteplace'])->name('deleteplace');
Route::get('/editplace/{id}', [PlaceController::class, 'editplace'])->name('editplace');
Route::put('/updateplace/{id}', [PlaceController::class, 'updateplace'])->name('updateplace');



Route::get('/employee', [EmployeeController::class, 'viewemployee'])->name('viewemployee');
Route::post('/addemployee', [EmployeeController::class, 'addFormemployee'])->name('addemployee');
Route::delete('/delete-employee/{id}', [EmployeeController::class, 'deleteemployee'])->name('deleteemployee');
Route::post('/updateemployee', [EmployeeController::class, 'updateemployee'])->name('updateemployee');

Route::get('/viewpositions', [PositionController::class, 'viewpositions'])->name('viewposition');
Route::post('/addposition', [PositionController::class, 'addFormpos'])->name('addformpos');
Route::delete('/deleteposition/{id}', [PositionController::class, 'deleteposition'])->name('deleteposition');
Route::post('/updateposition', [PositionController::class, 'updateposition'])->name('updateposition');
