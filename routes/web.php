<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/viewpositions', [PositionController::class, 'viewpositions'])->name('viewposition');
Route::post('/addposition', [PositionController::class, 'addFormpos'])->name('addformpos');
Route::delete('/deleteposition/{id}', [PositionController::class, 'deleteposition'])->name('deleteposition');
Route::get('/editposition/{id}', [PositionController::class, 'editposition'])->name('editposition');
Route::put('/updateposition/{id}', [PositionController::class, 'updateposition'])->name('updateposition');
Route::get('/positions/list', [PositionController::class, 'positionListTable'])->name('positionlisttable');

Route::get('/viewemployee', [EmployeeController::class, 'index'])->name('viewemployee');
Route::delete('/deleteemployee/{id}', [EmployeeController::class, 'destroy'])->name('deleteemployee');
Route::post('/storeemployee', [EmployeeController::class, 'store'])->name('storeemployee');
Route::get('/editemployee/{id}', [EmployeeController::class, 'edit'])->name('editemployee');
Route::put('/updateemployee/{id}', [EmployeeController::class, 'update'])->name('updateemployee');
Route::get('/employeeListTable', [EmployeeController::class, 'employeeListTable'])->name('employeeListTable');

Route::get('/viewFees', [FeeController::class, 'viewFees'])->name('viewfees');
Route::post('/addfee', [FeeController::class, 'addFee'])->name('addfee');
Route::delete('/deletefee/{id}', [FeeController::class, 'deleteFee'])->name('deletefee');
Route::get('/editfee/{id}', [FeeController::class, 'editFee'])->name('editfee');
Route::put('/updatefee/{id}', [FeeController::class, 'updateFee'])->name('updatefee');
Route::get('/feelisttable', [FeeController::class, 'feeListTable'])->name('feelisttable');

// Route::get('/place', [PlaceController::class, 'viewPlaces'])->name('viewplace');
Route::post('/addform', [PlaceController::class, 'addForm'])->name('addform');
// Route::delete('/delete-place/{id}', [PlaceController::class, 'deleteplace'])->name('deleteplace');
// Route::get('/editplace/{id}', [PlaceController::class, 'editplace'])->name('editplace');
// Route::put('/updateplace/{id}', [PlaceController::class, 'updateplace'])->name('updateplace');
// Route::get('/placelisttable', [PlaceController::class, 'placeListTable'])->name('placelisttable');



Route::get('viewplace', [PlaceController::class, 'viewPlaces'])->name('viewplace');
Route::get('placelisttable', [PlaceController::class, 'placeListTable'])->name('placelisttable');
Route::get('editplace/{id}', [PlaceController::class, 'editplace'])->name('editplace');
Route::put('updateplace/{id}', [PlaceController::class, 'updateplace'])->name('updateplace');
Route::delete('deleteplace/{id}', [PlaceController::class, 'deleteplace'])->name('deleteplace');

