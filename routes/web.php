<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessWarehouseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\DraftPurchaseOrderController;
use App\Http\Controllers\EBuyerSurveyAnswerController;
use App\Http\Controllers\ECartController;
use App\Http\Controllers\EOrdersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlacedRFQController;
use App\Http\Controllers\POInfoController;
use App\Http\Controllers\PurchaseRequestFormController;
use App\Http\Controllers\QouteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentCartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\DraftPurchaseOrder;
use App\Models\TrackingDelivery;
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
    return view('welcomeAr');
});
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum'])->resource('users', UserController::class);
//Route::middleware(['auth:sanctum'])->post('createUserForCompany/{business}', [\App\Http\Controllers\UserController::class, 'createUserForCompany'])->name('createUserForCompany');
Route::middleware(['auth:sanctum'])->post('/registrationType', [UserController::class, 'registrationType']);
Route::middleware(['auth:sanctum'])->resource('/business', BusinessController::class);
Route::middleware(['auth:sanctum'])->get('/business-status', [BusinessController::class , 'accountStatus'])->name('accountStatus');
Route::middleware(['auth:sanctum'])->resource('/businessFinanceDetail', \App\Http\Controllers\BusinessFinanceDetailController::class);
Route::middleware(['auth:sanctum'])->resource('/businessWarehouse', BusinessWarehouseController::class);
Route::middleware(['auth:sanctum'])->get('/businessWarehouse/{id}/show', [BusinessWarehouseController::class, 'businessWarehouseShow'])->name('businessWarehouseShow');
Route::middleware(['auth:sanctum'])->resource('/purchaseOrderInfo', POInfoController::class);

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
Route::post('e-buyer', [EBuyerSurveyAnswerController::class, 'store'])->name('eBuyerEn');
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
Route::resource('contact', ContactController::class);
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
Route::get('/download/answers', [ EBuyerSurveyAnswerController::class, 'export'])->name('downloadAnswersExcel');

Route::get('/download/supplier', [EBuyerSurveyAnswerController::class, 'supplier'])->name('downloadSupplierExcel');
Route::get('/download/buyer', [EBuyerSurveyAnswerController::class, 'buyer'])->name('downloadBuyerExcel');
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
Route::middleware(['auth:sanctum'])->get('/RFQPlacedItems/{EOrderItems}', [PlacedRFQController::class, 'RFQItems'])->name('RFQItemsByID');
Route::middleware(['auth:sanctum'])->get('/viewRFQs', [PlacedRFQController::class, 'viewRFQs'])->name('viewRFQs');
Route::middleware(['auth:sanctum'])->get('/viewRFQs/{eOrderItems}', [PlacedRFQController::class, 'viewRFQsID'])->name('viewRFQsID');
Route::middleware(['auth:sanctum'])->get('/RFQsQouted', [PlacedRFQController::class, 'RFQsQouted'])->name('RFQsQouted');

#################### Roles display and update ##########################
Route::resource('/role', RoleController::class);
//Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'show'])->name('roles');
//>>>>>>>>>>>>>>>This is Permission Route<<<<<<<<<<<<<<<<<<<<<<<
Route::resource('/permission', PermissionController::class);
#################### END ##########################
//>>>>>>This is Business informtion rout to check tatus of business <<<<<<<<<<<<<<<<
Route::get('business/Approval/Update/{id}', [BusinessController::class, 'businessApprovalUpdate'])->name('businessApprovalUpdate');
Route::get('business/Approval/Rejected/{id}', [BusinessController::class, 'businessApprovalRejected'])->name('businessApprovalRejected');
Route::middleware(['auth:sanctum'])->resource('qoute', QouteController::class);

Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/Qouted', [QouteController::class, 'QoutedRFQQouted'])->name('QoutedRFQQouted');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/Rejected', [QouteController::class, 'QoutedRFQRejected'])->name('QoutedRFQRejected');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/ModificationNeeded', [QouteController::class, 'QoutedRFQModificationNeeded'])->name('QoutedRFQModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/PendingConfirmation', [QouteController::class, 'QoutedRFQQoutedRFQPendingConfirmation'])->name('QoutedRFQPendingConfirmation');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived', [QouteController::class, 'QoutationsBuyerReceived'])->name('QoutationsBuyerReceived');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/{QouteItem}', [QouteController::class, 'QoutationsBuyerReceivedQouteID'])->name('QoutationsBuyerReceivedQouteID');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderItems}', [QouteController::class, 'QoutationsBuyerReceivedRFQItemsByID'])->name('QoutationsBuyerReceivedRFQItemsByID');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/qoutes/{EOrderItemID}', [QouteController::class, 'QoutationsBuyerReceivedQoutes'])->name('QoutationsBuyerReceivedQoutes');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/rejected/{EOrderItemID}', [QouteController::class, 'QoutationsBuyerReceivedRejected'])->name('QoutationsBuyerReceivedRejected');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/modification/{EOrderItemID}', [QouteController::class, 'QoutationsBuyerReceivedModificationNeeded'])->name('QoutationsBuyerReceivedModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/accepted/{EOrderItemID}', [QouteController::class, 'QoutationsBuyerReceivedAccepted'])->name('QoutationsBuyerReceivedAccepted');

Route::middleware(['auth:sanctum'])->resource('QuotationMessage', \App\Http\Controllers\QouteMessageController::class);
Route::middleware(['auth:sanctum'])->get('qoute/{qoute}/ModificationNeeded', [QouteController::class, 'updateModificationNeeded'])->name('updateQoute');
Route::middleware(['auth:sanctum'])->get('qoute/{qoute}/Rejected', [QouteController::class, 'updateRejected'])->name('updateRejected');
Route::middleware(['auth:sanctum'])->post('qoute/{qoute}/Accepted', [QouteController::class, 'qouteAccepted'])->name('qouteAccepted');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'show'])->name('dpo.show');
Route::middleware(['auth:sanctum'])->get('dpo', [DraftPurchaseOrderController::class, 'index'])->name('dpo.index');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}/approved', [DraftPurchaseOrderController::class, 'approved'])->name('dpo.approved');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}/rejected', [DraftPurchaseOrderController::class, 'rejected'])->name('dpo.rejected');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}/cancel', [DraftPurchaseOrderController::class, 'cancel'])->name('dpo.cancel');



#################### PDF generate Routes ##########################
Route::middleware(['auth:sanctum'])->get('/generate-PO-pdf/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'generatePDF'])->name('generatePDF');
#################### END ##########################################

#################### PDF generate Routes ##########################
Route::middleware(['auth:sanctum'])->get('/logviewer', function () {return redirect('admin/logviewer');})->name('log.viewer');
#################### END ##########################################

#################### Delivery and Delivery Note ##########################
Route::middleware(['auth:sanctum'])->resource('delivery', DeliveryController::class);
Route::middleware(['auth:sanctum'])->get('/deliveryNote/{draftPurchaseOrder}/view', [DeliveryNoteController::class, 'deliveryNoteView'])->name('deliveryNoteView');
Route::middleware(['auth:sanctum'])->resource('deliveryNote', DeliveryNoteController::class);
#################### END ##################################################

##################### Draft purchase order routes ####################################
Route::middleware(['auth:sanctum'])->get('/po', [DraftPurchaseOrderController::class, 'po'])->name('po.po');
Route::middleware(['auth:sanctum'])->get('/po/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'poShow'])->name('po.show');
Route::middleware(['auth:sanctum'])->get('/notes', [DeliveryNoteController::class, 'notes'])->name('notes');
Route::middleware(['auth:sanctum'])->get('/notes/{deliveryNote}', [DeliveryNoteController::class, 'viewNote'])->name('viewNote');
#################### END ##################################################

##################### Shipment routes ####################################
Route::middleware(['auth:sanctum'])->resource('shipment', ShipmentController::class);
Route::middleware(['auth:sanctum'])->resource('shipmentCart', ShipmentCartController::class);
Route::middleware(['auth:sanctum'])->resource('shipmentItem', ShipmentItemController::class);
#################### END ##################################################


###################### Vehicle routes ####################################
Route::middleware(['auth:sanctum'])->resource('vehicle', VehicleController::class);
#################### END ##################################################


###################### Generate Invoice & Delivery ####################################
Route::middleware(['auth:sanctum'])->post('/invoice/generate', [InvoiceController::class, 'invoiceGenerate'])->name('invoice.generate');
Route::middleware(['auth:sanctum'])->get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
#################### END ##############################################################
#
####################### Payment routes ####################################
Route::middleware(['auth:sanctum'])->resource('payment', PaymentController::class);
Route::middleware(['auth:sanctum'])->get('generate-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoiceView'])->name('generateProformaView');
Route::middleware(['auth:sanctum'])->get('create-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoice'])->name('generateProforma');
Route::middleware(['auth:sanctum'])->get('invoices-history', [PaymentController::class, 'invoices'])->name('invoices');
Route::middleware(['auth:sanctum'])->get('proforma-invoices', [PaymentController::class, 'proforma_invoices'])->name('proforma_invoices');
#################### END ##############################################################

Route::get('check', function (){
    return view('business.buyerPolicy');
});
