<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ECartController;
use App\Http\Controllers\EOrdersController;
use App\Http\Controllers\PlacedRFQController;
use \App\Http\Controllers\PurchaseRequestFormController;
use App\Models\ECart;
use App\Models\EOrders;
use App\Models\PlacedRFQ;


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

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::resource('users', \App\Http\Controllers\UserController::class);

Route::post('createUserForCompany/{business}', [\App\Http\Controllers\UserController::class, 'createUserForCompany'])->name('createUserForCompany');

Route::post('/registrationType', [\App\Http\Controllers\UserController::class, 'registrationType']);
Route::resource('/business', \App\Http\Controllers\BusinessController::class);
Route::resource('/businessFinanceDetail', \App\Http\Controllers\BusinessFinanceDetailController::class);
Route::resource('/businessWarehouse', \App\Http\Controllers\BusinessWarehouseController::class);
Route::get('/businessWarehouse/{id}/show', [\App\Http\Controllers\BusinessWarehouseController::class, 'businessWarehouseShow'])->name('businessWarehouseShow');
Route::resource('/purchaseOrderInfo', \App\Http\Controllers\POInfoController::class);

####################Survey###################
Route::get('/survey', function () {
    return view('website.survey');
});
Route::get('/survey/ar', function () {
    return view('website.surveyAr');
});
Route::get('/e-buyer/en', function () {
    return view('eBuyerSurvey.en.eBuyerSurvey');
});
Route::get('/e-buyer/ar', function () {
    return view('eBuyerSurvey.ar.eBuyerSurvey');
});
Route::get('/e-buyer/ur', function () {
    return view('eBuyerSurvey.ur.eBuyerSurvey');
});
Route::post('e-buyer', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'store'])->name('eBuyerEn');
####################END######################


####################  Website    ###################
Route::get('/aboutUs', function () {
    return view('website.aboutUs');
})->name('aboutUs');
Route::get('/services', function () {
    return view('website.services');
})->name('services');
Route::get('/ourTeam', function () {
    return view('website.ourTeam');
})->name('ourTeam');
Route::get('/support', function () {
    return view('website.support');
})->name('support');
Route::resource('contact', \App\Http\Controllers\ContactController::class);
#################### End Website ###################

####################  Website AR    ###################
Route::get('/en', function () {
    return view('welcome');
})->name('ar');
Route::get('/aboutUsAr', function () {
    return view('website.aboutUsAr');
})->name('aboutUsAr');
Route::get('/servicesAr', function () {
    return view('website.servicesAr');
})->name('servicesAr');
Route::get('/ourTeamAr', function () {
    return view('website.ourTeamAr');
})->name('ourTeamAr');
Route::get('/supportAr', function () {
    return view('website.supportAr');
})->name('supportAr');
#################### End Website AR ###################


####################Survey Supplier###################
Route::get('/e-supplier/en', function () {
    return view('eBuyerSurvey.en.eSupplierSurvey');
});
Route::get('/e-supplier/ar', function () {
    return view('eBuyerSurvey.ar.eSupplierSurvey');
});
####################END###############################


####################Download Answers###################
Route::get('/download/answers', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'export'])->name('downloadAnswersExcel');
Route::get('/download/supplier', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'supplier'])->name('downloadSupplierExcel');
Route::get('/download/buyer', [\App\Http\Controllers\EBuyerSurveyAnswerController::class, 'buyer'])->name('downloadBuyerExcel');
Route::get('/downloads', function () {
    return view('website.downloads');
})->name('downloads');
####################END###############################

####################Category##########################
Route::middleware(['auth:sanctum'])->get('category/show', [CategoryController::class, 'showAllCategories'])->name('showAllCategory');
Route::middleware(['auth:sanctum'])->resource('category', CategoryController::class);
####################END###############################


#################### RFP Purchase Request Form ##########################
Route::middleware(['auth:sanctum'])->resource('RFQ', PurchaseRequestFormController::class);
Route::middleware(['auth:sanctum'])->resource('RFQCart', ECartController::class);
Route::middleware(['auth:sanctum'])->resource('EOrders', EOrdersController::class);
Route::middleware(['auth:sanctum'])->resource('PlacedRFQ', PlacedRFQController::class);
#########################################################################
Route::middleware(['auth:sanctum'])->get('/RFQPlacedItems/{EOrderItems}', [\App\Http\Controllers\PlacedRFQController::class, 'RFQItems'])->name('RFQItemsByID');
Route::middleware(['auth:sanctum'])->get('/viewRFQs', [\App\Http\Controllers\PlacedRFQController::class, 'viewRFQs'])->name('viewRFQs');
Route::middleware(['auth:sanctum'])->get('/viewRFQs/{eOrderItems}', [\App\Http\Controllers\PlacedRFQController::class, 'viewRFQsID'])->name('viewRFQsID');
Route::middleware(['auth:sanctum'])->get('/RFQsQouted', [\App\Http\Controllers\PlacedRFQController::class, 'RFQsQouted'])->name('RFQsQouted');










// Route::middleware(['auth:sanctum','verified'])->group(function(){

// Route::resource('/roles',Role::Class);
//     })



// Route::middleware(['auth:sanctum'])->get('/roles', function () {
//     $role=Role::all();
//      return view('Role/index',compact('role'));
// })->name('roles');

// Route::middleware(['auth:sanctum'])->get('/edit/{id}', function () {
//     $role=Role::findOrFail($id);
//      return view('Role/edit',compact('role'));
// })->name('edit');


// // Route::resource('/role',Role::class)
// Route::get('/roles', [\App\Http\Controllers\RoleController::class,'index'])->name('role.index');
// Route::post('/roles/{$id}/edit', [\App\Http\Controllers\RoleController::class,'edit'])->name('role.edit');
// // Route::post('/roles/update/{$id}', [\App\Http\Controllers\RoleController::class,'update'])->name('role.update');
// Route::get('/roles/create', [\App\Http\Controllers\RoleController::class,'create'])->name('role.create');



Route::resource('/role',\App\Http\Controllers\RoleController::class);
Route::resource('/permission',\App\Http\Controllers\PermissionController::class);


// Route::middleware(['auth:sanctum'])->get('/role', function () {


//     //    $role = Role::create(['name' => 'CEO']);
//     //    $role = Role::create(['name' => 'User']);
//     //    $permission = Permission::create(['name' => 'all']);
//     //    $permission = Permission::create(['name' => 'delete user']);
//     //    $permission = Permission::create(['name' => 'create user']);
//     //    $permission = Permission::create(['name' => 'read user']);
//     //    $permission = Permission::create(['name' => 'PoBuyer']);
//     //    $permission = Permission::create(['name' => 'QoSupplier']);

//     //    $role = Role::findByName('User');
//     //    $user = \App\Models\User::find(5);
//     //    $permissions = $user->getDirectPermissions();
//     //    $permissions = $user->getPermissionsViaRoles();
//     //    $permissions = $user->getRoleNames();
//     //    return $permissions;

//     //    $role = Role::findByName('SuperAdmin');
//     //    $role1->givePermissionTo('delete user');
//     //    $role1->givePermissionTo('create user');
//     //    $role = Role::findByName('User');
//     //    $role->revokePermissionTo(['PoBuyer','QoSupplier']);
//     //      $role->givePermissionTo('PoBuyer');
//     //      $role->givePermissionTo('QoSupplier');
//     //    $role1->givePermissionTo('read user');
//     //    $user = \App\Models\User::findOrFail(5);
//     //    $permission = Permission::findByName('delete user');
//     //    dd($role1);
//     //    $role->givePermissionTo($permission);
//     //    $user = \App\Models\User::find(5);
//     //    $role = Role::findByName('SuperAdmin');
//     //    $user->assignRole($role);
// });

// //
// Route::get('/test', function () {

//     //    $categories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//     //    return view('manageChild',compact('categories'));
//     return view('test');
// });
