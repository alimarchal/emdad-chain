<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
    return view('welcomeAr');
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

####################Survey###################
Route::get('/survey', function(){return view('website.survey');});
Route::get('/survey/ar', function(){return view('website.surveyAr');});
Route::get('/e-buyer/en', function(){return view('eBuyerSurvey.en.eBuyerSurvey');});
Route::get('/e-buyer/ar', function(){return view('eBuyerSurvey.ar.eBuyerSurvey');});
Route::get('/e-buyer/ur', function(){return view('eBuyerSurvey.ur.eBuyerSurvey');});
Route::post('e-buyer', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'store'])->name('eBuyerEn');
####################END######################


####################  Website    ###################
Route::get('/aboutUs', function(){return view('website.aboutUs');})->name('aboutUs');
Route::get('/services', function(){return view('website.services');})->name('services');
Route::get('/ourTeam', function(){return view('website.ourTeam');})->name('ourTeam');
Route::get('/support', function(){return view('website.support');})->name('support');
Route::resource('contact', \App\Http\Controllers\ContactController::class);
#################### End Website ###################

####################  Website AR    ###################
Route::get('/en', function () {return view('welcome');})->name('ar');
Route::get('/aboutUsAr', function(){return view('website.aboutUsAr');})->name('aboutUsAr');
Route::get('/servicesAr', function(){return view('website.servicesAr');})->name('servicesAr');
Route::get('/ourTeamAr', function(){return view('website.ourTeamAr');})->name('ourTeamAr');
Route::get('/supportAr', function(){return view('website.supportAr');})->name('supportAr');
#################### End Website AR ###################


####################Survey Supplier###################
Route::get('/e-supplier/en', function(){return view('eBuyerSurvey.en.eSupplierSurvey');});
Route::get('/e-supplier/ar', function(){return view('eBuyerSurvey.ar.eSupplierSurvey');});
####################END###############################


####################Download Answers###################
Route::get('/download/answers',[\App\Http\Controllers\EBuyerSurveyAnswerController::class,'export'])->name('downloadAnswersExcel');
Route::get('/download/supplier',[\App\Http\Controllers\EBuyerSurveyAnswerController::class,'supplier'])->name('downloadSupplierExcel');
Route::get('/download/buyer',[\App\Http\Controllers\EBuyerSurveyAnswerController::class,'buyer'])->name('downloadBuyerExcel');
Route::get('/downloads', function(){return view('website.downloads');})->name('downloads');
####################END###############################


Route::get('/role', function(){

//    $role = Role::create(['name' => 'CEO']);
//    $role = Role::create(['name' => 'User']);
//    $permission = Permission::create(['name' => 'all']);
//    $permission = Permission::create(['name' => 'delete user']);
//    $permission = Permission::create(['name' => 'create user']);
//    $permission = Permission::create(['name' => 'read user']);
//    $permission = Permission::create(['name' => 'PoBuyer']);
//    $permission = Permission::create(['name' => 'QoSupplier']);

//    $role = Role::findByName('User');
    $user = \App\Models\User::find(5);
//    $permissions = $user->getDirectPermissions();
//    $permissions = $user->getPermissionsViaRoles();
    $permissions = $user->getRoleNames();
    return $permissions;

//    $role = Role::findByName('SuperAdmin');
//    $role1->givePermissionTo('delete user');
//    $role1->givePermissionTo('create user');
//    $role = Role::findByName('User');
//    $role->revokePermissionTo(['PoBuyer','QoSupplier']);
//      $role->givePermissionTo('PoBuyer');
//      $role->givePermissionTo('QoSupplier');
//    $role1->givePermissionTo('read user');
//    $user = \App\Models\User::findOrFail(5);
//    $permission = Permission::findByName('delete user');
//    dd($role1);
//    $role->givePermissionTo($permission);
//    $user = \App\Models\User::find(5);
//    $role = Role::findByName('SuperAdmin');
//    $user->assignRole($role);
});


Route::get('/test', function(){
    return view('index');
});
