<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('users', \App\Http\Controllers\UserController::class);
Route::post('createUserForCompany/{business}', [\App\Http\Controllers\UserController::class,'createUserForCompany'])->name('createUserForCompany');
Route::post('/registrationType', [\App\Http\Controllers\UserController::class, 'registrationType']);
//Route::post('/business',[\App\Http\Controllers\BusinessController::class, 'store']);
Route::resource('/business', \App\Http\Controllers\BusinessController::class);
Route::resource('/businessFinanceDetail', \App\Http\Controllers\BusinessFinanceDetailController::class);
Route::resource('/businessWarehouse', \App\Http\Controllers\BusinessWarehouseController::class);
Route::get('/businessWarehouse/{id}/show', [\App\Http\Controllers\BusinessWarehouseController::class,'businessWarehouseShow'])->name('businessWarehouseShow');
Route::resource('/purchaseOrderInfo', \App\Http\Controllers\POInfoController::class);
//Route::resource('/logisticDetail', \App\Http\Controllers\LogisticDetailController::class);
//Route::resource('/category', \App\Http\Controllers\CategoryController::class);
Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index']);

Route::get('/test', function(\Illuminate\Http\Request $request){
    return dd($request->all());
});

// survey buyer

Route::get('/e-buyer/en', function(){
    return view('eBuyerSurvey.en.eBuyerSurvey');
});

Route::get('/e-buyer/ar', function(){
    return view('eBuyerSurvey.ar.eBuyerSurvey');
});

Route::get('/e-buyer/ur', function(){
    return view('eBuyerSurvey.ur.eBuyerSurvey');
});

Route::post('e-buyer', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'store'])->name('eBuyerEn');

