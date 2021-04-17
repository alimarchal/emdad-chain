<?php

use App\Http\Controllers\BankPaymentController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessPackageController;
use App\Http\Controllers\BusinessWarehouseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\DraftPurchaseOrderController;
use App\Http\Controllers\EBuyerSurveyAnswerController;
use App\Http\Controllers\ECartController;
use App\Http\Controllers\EmdadInvoiceController;
use App\Http\Controllers\EOrdersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlacedRFQController;
use App\Http\Controllers\POInfoController;
use App\Http\Controllers\PurchaseRequestFormController;
use App\Http\Controllers\QouteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerLoginController;
use App\Http\Controllers\ShipmentCartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WebsiteArabicController;
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
Route::middleware(['auth:sanctum', 'verified'])->post('languageChange', [DashboardController::class, 'languageChange'])->name('languageChange');
Route::middleware(['auth:sanctum'])->resource('users', UserController::class);
//Route::middleware(['auth:sanctum'])->post('createUserForCompany/{business}', [\App\Http\Controllers\UserController::class, 'createUserForCompany'])->name('createUserForCompany');
Route::middleware(['auth:sanctum'])->post('/registrationType', [UserController::class, 'registrationType']);
Route::middleware(['auth:sanctum'])->resource('/business', BusinessController::class);

Route::middleware(['auth:sanctum'])->get('/incomplete-business-registration/', [BusinessController::class, 'incomplete'])->name('incompleteBusiness');
Route::middleware(['auth:sanctum'])->get('/business-status/', [BusinessController::class, 'accountStatus'])->name('accountStatus');

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


####################  Shipter Website Template   ###################
####################     WebsiteEnglish          ###################
Route::get('/english', [\App\Http\Controllers\WebsiteEnglishController::class, 'index'])->name('english.index');
Route::get('/en-about', [\App\Http\Controllers\WebsiteEnglishController::class, 'about'])->name('english.about');
Route::get('/en-service', [\App\Http\Controllers\WebsiteEnglishController::class, 'service'])->name('english.service');
Route::get('/en-team', [\App\Http\Controllers\WebsiteEnglishController::class, 'team'])->name('english.team');
Route::get('/en-contact', [\App\Http\Controllers\WebsiteEnglishController::class, 'contact'])->name('english.contact');
Route::get('/en-survey', [\App\Http\Controllers\WebsiteEnglishController::class, 'survey'])->name('english.survey');
Route::get('/en-buyer-survey', [\App\Http\Controllers\WebsiteEnglishController::class, 'buyerSurvey'])->name('english.buyerSurvey');
Route::get('/en-supplier-survey', [\App\Http\Controllers\WebsiteEnglishController::class, 'supplierSurvey'])->name('english.supplierSurvey');
Route::get('/en-buyer-package', [\App\Http\Controllers\WebsiteEnglishController::class, 'buyerPackage'])->name('english.buyerPackage');
Route::get('/en-supplier-package', [\App\Http\Controllers\WebsiteEnglishController::class, 'supplierPackage'])->name('english.supplierPackage');

####################     WebsiteArabic          ###################
Route::get('/arabic', [WebsiteArabicController::class, 'index'])->name('arabic.index');
Route::get('/ar-about', [WebsiteArabicController::class, 'about'])->name('arabic.about');
Route::get('/ar-service', [WebsiteArabicController::class, 'service'])->name('arabic.service');
Route::get('/ar-team', [WebsiteArabicController::class, 'team'])->name('arabic.team');
Route::get('/ar-contact', [WebsiteArabicController::class, 'contact'])->name('arabic.contact');
Route::get('/ar-survey', [WebsiteArabicController::class, 'survey'])->name('arabic.survey');
Route::get('/ar-buyer-survey', [WebsiteArabicController::class, 'buyerSurvey'])->name('arabic.buyerSurvey');
Route::get('/ar-supplier-survey', [WebsiteArabicController::class, 'supplierSurvey'])->name('arabic.supplierSurvey');
Route::get('/ar-buyer-package', [WebsiteArabicController::class, 'buyerPackage'])->name('arabic.buyerPackage');
Route::get('/ar-supplier-package', [WebsiteArabicController::class, 'supplierPackage'])->name('arabic.supplierPackage');










####################  END   ###################
####################  Website    ######################################

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
Route::get('/registerAr', function () {
    return view('auth.registerAr');
})->name('registerAr');
Route::get('/loginAr', function () {
    return view('auth.loginAr');
})->name('loginAr');
//Route::get('/dashboard_ar', function () {
//    return view('_layouts.sidebarAr');
//})->name('sidebarAr');


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
Route::get('/download/answers', [EBuyerSurveyAnswerController::class, 'export'])->name('downloadAnswersExcel');

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
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/qoutes/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedQoutes'])->name('QoutationsBuyerReceivedQoutes');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/rejected/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedRejected'])->name('QoutationsBuyerReceivedRejected');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/modification/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedModificationNeeded'])->name('QoutationsBuyerReceivedModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/accepted/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedAccepted'])->name('QoutationsBuyerReceivedAccepted');

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
Route::middleware(['auth:sanctum'])->get('/logviewer', function () {
    return redirect('admin/logviewer');
})->name('log.viewer');
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
Route::middleware(['auth:sanctum'])->get('/emdad-invoices/', [EmdadInvoiceController::class, 'index'])->name('emdadInvoices');
Route::middleware(['auth:sanctum'])->get('/emdad-invoice/{id}', [EmdadInvoiceController::class, 'view'])->name('emdadInvoiceView');
Route::middleware(['auth:sanctum'])->get('/generate-emdad-invoice/{id}', [EmdadInvoiceController::class, 'generateInvoice'])->name('emdadGenerateInvoice');
#################### END ##############################################################
#
####################### Payment routes ####################################
Route::middleware(['auth:sanctum'])->resource('payment', PaymentController::class);
Route::middleware(['auth:sanctum'])->get('generate-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoiceView'])->name('generateProformaView');
Route::middleware(['auth:sanctum'])->get('create-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoice'])->name('generateProforma');
Route::middleware(['auth:sanctum'])->get('invoices-history', [PaymentController::class, 'invoices'])->name('invoices');
Route::middleware(['auth:sanctum'])->get('proforma-invoices', [PaymentController::class, 'proforma_invoices'])->name('proforma_invoices');
Route::middleware(['auth:sanctum'])->get('generate-proforma-invoice', [PaymentController::class, 'generate_proforma_invoice'])->name('generate_proforma_invoices');
Route::middleware(['auth:sanctum'])->resource('bank-payments', BankPaymentController::class)->names('bank-payments');
Route::middleware(['auth:sanctum'])->get('bank-payments/{invoice}/create', [BankPaymentController::class, 'create'])->name('bank-payments.create');
Route::middleware(['auth:sanctum'])->get('bank-payments/{invoice}/edit', [BankPaymentController::class, 'edit'])->name('bank-payments.edit');
Route::middleware(['auth:sanctum'])->post('bank-payments/update', [BankPaymentController::class, 'update_payment'])->name('bank_payments_update');
//Route::middleware(['auth:sanctum'])->resource('moyasar-payment', Moyas::class)->names('mps');
#################### END ##############################################################


####################### Subscription routes ####################################
// Route::middleware(['auth:sanctum'])->get('sub', function () {
//     return view('subscription.index');
// })->name('subscription');
#################### END ##############################################################

Route::post('/make-payment', [\App\Http\Controllers\MakePaymentController::class, 'makePayment'])->name('make.payment');
Route::get('/payment-status', [\App\Http\Controllers\MakePaymentController::class, 'paymentStatus'])->name('payment.status');
//return view('moyasar_payment.payment');


Route::middleware(['auth:sanctum'])->resource('packages', PackageController::class);
Route::middleware(['auth:sanctum'])->get('business-packages/status', [\App\Http\Controllers\BusinessPackageController::class, 'businessPackagePaymentStatus'])->name('businessPackage.paymentStatus');
Route::middleware(['auth:sanctum'])->resource('business-packages', BusinessPackageController::class);
Route::middleware(['auth:sanctum'])->post('updateCategories', [BusinessPackageController::class, 'updateCategories'])->name('updatePackageCategories');
Route::middleware(['auth:sanctum'])->post('business-package-store/{id}', [BusinessPackageController::class, 'store'])->name('business-package.store');

#################### END ##############################################################

//Route::middleware(['auth:sanctum'])->get('select-category', function (){
//    $parentCategories = \App\Models\Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//    return view('category.show.categories', compact('parentCategories'));
//})->name('cat');
//Route::middleware(['auth:sanctum'])->get('sub-categories', function (){
//    $category = \App\Models\Category::where('parent_id', 0)->orderBy('name', 'asc')->get();;
//    return view('category.show.subCategories', compact('category'));
//})->name('cats');

Route::middleware(['auth:sanctum'])->get('select-category', [CategoryController::class, 'parentCategories'])->name('parentCategories');
Route::middleware(['auth:sanctum'])->get('sub-categories', [CategoryController::class, 'subCategories'])->name('subCategories');

Route::get('/testOne', function () {
    return view('test');
});

####################### Sales routes ####################################
Route::get('seller-register', [SellerController::class, 'register_view'])->name('sellerRegister');
Route::post('seller-register', [SellerController::class, 'seller_create']);
Route::get('ar-seller-register', [SellerController::class, 'register_arabic_view'])->name('sellerRegisterArabic');

Route::get('seller-login', [SellerLoginController::class, 'login_view'])->name('sellerLogin');
Route::post('seller-login', [SellerLoginController::class, 'login']);
Route::get('ar-seller-login', [SellerLoginController::class, 'arabic_login_view'])->name('sellerLoginArabic');

Route::get('seller-dashboard', [SellerController::class, 'dashboard'])->name('sellerDashboard')->middleware('seller');
#################### END ##################################################

