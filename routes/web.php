<?php

use App\Http\Controllers\AdminDownloadController;
use App\Http\Controllers\AdminIreController;
use App\Http\Controllers\BankPaymentController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessPackageController;
use App\Http\Controllers\BusinessWarehouseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommissionPercentageController;
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
use App\Http\Controllers\IreRegisterController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlacedRFQController;
use App\Http\Controllers\POInfoController;
use App\Http\Controllers\PurchaseRequestFormController;
use App\Http\Controllers\QouteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IreController;
use App\Http\Controllers\IreLoginController;
use App\Http\Controllers\ShipmentCartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WebsiteArabicController;
use App\Models\DraftPurchaseOrder;
use App\Models\TrackingDelivery;
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

//Route::get('/', function () {
//    return view('welcomeAr');
//});
Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->post('languageChange', [DashboardController::class, 'languageChange'])->name('languageChange');
Route::middleware(['auth:sanctum'])->resource('users', UserController::class);
//Route::middleware(['auth:sanctum'])->post('createUserForCompany/{business}', [\App\Http\Controllers\UserController::class, 'createUserForCompany'])->name('createUserForCompany');
Route::middleware(['auth:sanctum'])->post('/registrationType', [UserController::class, 'registrationType']);

###################################################### Buyer and Supplier Add each other ##########################################
Route::middleware(['auth:sanctum', 'verified'])->get('add-supplier', [UserController::class, 'createSupplier'])->name('createSupplier');
Route::middleware(['auth:sanctum', 'verified'])->post('store-supplier', [UserController::class, 'storeSupplier'])->name('storeSupplier');
Route::middleware(['auth:sanctum', 'verified'])->get('add-buyer', [UserController::class, 'createBuyer'])->name('createBuyer');
Route::middleware(['auth:sanctum', 'verified'])->post('store-buyer', [UserController::class, 'storeBuyer'])->name('storeBuyer');

Route::middleware(['auth:sanctum'])->get('/business-suppliers/', [BusinessController::class, 'suppliers'])->name('businessSuppliers');
Route::middleware(['auth:sanctum'])->get('/business-buyers/', [BusinessController::class, 'buyers'])->name('businessBuyers');
###################################################### Buyer and Supplier Adding each other ##########################################

Route::middleware(['packageCheck', 'categoryCheck'])->group(function () {
    Route::middleware(['auth:sanctum'])->resource('/business', BusinessController::class);
});

Route::middleware(['auth:sanctum'])->get('/incomplete-business-registration/', [BusinessController::class, 'incomplete'])->name('incompleteBusiness');
Route::middleware(['auth:sanctum'])->get('/business-status/', [BusinessController::class, 'accountStatus'])->name('accountStatus');
Route::middleware(['auth:sanctum'])->get('/business-legal-finance-status/', [BusinessController::class, 'businessLegalFinanceStatus'])->name('businessLegalFinanceStatus');

Route::middleware(['auth:sanctum'])->resource('/businessFinanceDetail', \App\Http\Controllers\BusinessFinanceDetailController::class);
Route::middleware(['auth:sanctum'])->resource('/businessWarehouse', BusinessWarehouseController::class);
Route::middleware(['auth:sanctum'])->get('/businessWarehouse/{id}/show', [BusinessWarehouseController::class, 'businessWarehouseShow'])->name('businessWarehouseShow');
Route::middleware(['auth:sanctum'])->resource('/purchaseOrderInfo', POInfoController::class);

####################Admin IREs Controller###################
Route::middleware(['auth:sanctum'])->get('/ires', [AdminIreController::class, 'index'])->name('adminIres');
Route::middleware(['auth:sanctum'])->get('/ire-show', [AdminIreController::class, 'show'])->name('adminIreShow');
Route::middleware(['auth:sanctum'])->post('/ire-edit', [AdminIreController::class, 'edit'])->name('adminIreEdit');
Route::middleware(['auth:sanctum'])->post('/ire-update', [AdminIreController::class, 'update'])->name('adminIreUpdate');
####################END#####################################


#####################Admin Downloads Controller###################
Route::middleware(['auth:sanctum'])->get('/downloadable-files', [AdminDownloadController::class, 'index'])->name('adminDownload');
Route::middleware(['auth:sanctum'])->get('/create-downloadable-file', [AdminDownloadController::class, 'create'])->name('adminDownloadCreate');
Route::middleware(['auth:sanctum'])->post('/store-downloadable-file', [AdminDownloadController::class, 'store'])->name('adminDownloadStore');
Route::middleware(['auth:sanctum'])->post('/edit-downloadable-file', [AdminDownloadController::class, 'edit'])->name('adminDownloadEdit');
Route::middleware(['auth:sanctum'])->post('/update-downloadable-file', [AdminDownloadController::class, 'update'])->name('adminDownloadUpdate');
Route::middleware(['auth:sanctum'])->get('/delete-downloadable-file/{id}', [AdminDownloadController::class, 'delete'])->name('adminDownloadDelete');
####################END#####################################

######################Admin Commission Controller###################
Route::middleware(['auth:sanctum'])->get('/commission-percentages', [CommissionPercentageController::class, 'index'])->name('adminPercentage');
Route::middleware(['auth:sanctum'])->get('/create-commission-percentage', [CommissionPercentageController::class, 'create'])->name('adminPercentageCreate');
Route::middleware(['auth:sanctum'])->post('/store-commission-percentage', [CommissionPercentageController::class, 'store'])->name('adminPercentageStore');
Route::middleware(['auth:sanctum'])->post('/edit-commission-percentage', [CommissionPercentageController::class, 'edit'])->name('adminPercentageEdit');
Route::middleware(['auth:sanctum'])->post('/update-commission-percentage', [CommissionPercentageController::class, 'update'])->name('adminPercentageUpdate');
Route::middleware(['auth:sanctum'])->get('/delete-commission-percentage/{id}', [CommissionPercentageController::class, 'delete'])->name('adminPercentageDelete');
####################END#####################################


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
Route::get('/', [WebsiteArabicController::class, 'index'])->name('arabic.index');
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

#####################  Policy And Procedure   ###################
//Route::get('/policy-procedure', view('policyProcedure.english.eula'))->name('policyProcedure.eula');
Route::view('/policy-procedure', 'policyProcedure.english.eula')->name('policyProcedure.eula');
Route::view('/ire-policy-procedure', 'policyProcedure.english.ire_pp')->name('policyProcedure.ire');
Route::view('/buyer-policy-procedure', 'policyProcedure.english.buyer_pp')->name('policyProcedure.buyer');
Route::view('/supplier-policy-procedure', 'policyProcedure.english.supplier_pp')->name('policyProcedure.supplier');

Route::view('/ar-policy-procedure', 'policyProcedure.arabic.eula')->name('arabic.policyProcedure.eula');
Route::view('/ar-ire-policy-procedure', 'policyProcedure.arabic.ire_pp')->name('arabic.policyProcedure.ire');
Route::view('/ar-buyer-policy-procedure', 'policyProcedure.arabic.buyer_pp')->name('arabic.policyProcedure.buyer');
Route::view('/ar-supplier-policy-procedure', 'policyProcedure.arabic.supplier_pp')->name('arabic.policyProcedure.supplier');
####################  End Policy And Procedure    ######################################

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
Route::middleware(['auth:sanctum'])->get('businesses-related-to-category/{category_id}', [CategoryController::class, 'categoryRelatedBusiness'])->name('categoryRelatedBusiness');
Route::middleware(['auth:sanctum'])->get('active-rfq/{rfq_id}', [CategoryController::class, 'activeRFQs'])->name('activeRFQs');
Route::middleware(['auth:sanctum'])->get('active-rfq-details/{rfq_id}', [CategoryController::class, 'activeRFQView'])->name('activeRFQView');
Route::middleware(['auth:sanctum'])->resource('category', CategoryController::class);
####################END###############################
#################### RFP Purchase Request Form ##########################
Route::middleware(['auth:sanctum'])->resource('RFQ', PurchaseRequestFormController::class);
Route::middleware(['auth:sanctum'])->resource('RFQCart', ECartController::class);
Route::middleware(['auth:sanctum'])->resource('EOrders', EOrdersController::class);
Route::middleware(['auth:sanctum'])->resource('PlacedRFQ', PlacedRFQController::class);
Route::get('/rfq-with-no-quotations', [PlacedRFQController::class, 'RFQsWithNoQuotations'])->name('RFQsWithNoQuotations');
Route::post('/change-company-check', [ECartController::class, 'companyCheck'])->name('companyCheck');
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

Route::middleware(['auth:sanctum'])->post('business-packages/step-one', [\App\Http\Controllers\BusinessPackageController::class, 'getCheckOutId'])->name('businessPackage.stepOne');

Route::middleware(['auth:sanctum'])->resource('business-packages', BusinessPackageController::class);

Route::middleware(['auth:sanctum'])->post('business-packages/checkout', [\App\Http\Controllers\BusinessPackageController::class, 'getCheckOutId'])->name('businessPackage.getCheckOutId');

Route::middleware(['auth:sanctum'])->post('updateCategories', [BusinessPackageController::class, 'updateCategories'])->name('updatePackageCategories');
Route::middleware(['auth:sanctum'])->post('business-package-store/{id}', [BusinessPackageController::class, 'store'])->name('business-package.store');

#################### END ##############################################################

Route::middleware(['auth:sanctum'])->get('select-category', [CategoryController::class, 'parentCategories'])->name('parentCategories');
Route::middleware(['auth:sanctum'])->get('sub-categories', [CategoryController::class, 'subCategories'])->name('subCategories');

############################################### SMS routes ########################################################
Route::middleware(['auth:sanctum'])->resource('smsMessages', \App\Http\Controllers\SmsMessagesController::class)->middleware('permission:all');


############################################### IREs routes ########################################################

Route::middleware(['ireAuthentication'])->group(function () {
    Route::get('ire-register', [IreRegisterController::class, 'register_view'])->name('ireRegister');
    Route::post('ire-register', [IreRegisterController::class, 'ire_register']);
    Route::get('ar-ire-register', [IreRegisterController::class, 'register_arabic_view'])->name('ireRegisterArabic');

    Route::get('ire-login', [IreLoginController::class, 'login_view'])->name('ireLogin');
    Route::post('ire-login', [IreLoginController::class, 'login']);
    Route::get('ire-forgot-password', [IreLoginController::class, 'forgot_password_view'])->name('ireForgotPassword');
    Route::post('ire-forgot-password', [IreLoginController::class, 'forgot_password']);
    Route::get('ar-ire-login', [IreLoginController::class, 'arabic_login_view'])->name('ireLoginArabic');
});
Route::get('/search', [IreLoginController::class, 'search_ire'])->name('search_ire');
Route::post('ireLanguageChange', [IreController::class, 'languageChange'])->name('ireLanguageChange');

Route::middleware(['ire'])->group(function () {
    Route::get('email-verify', [IreRegisterController::class, 'email_verify'])->name('ireEmailVerify');
    Route::post('resend-email-verify', [IreRegisterController::class, 'resend_email_verification'])->name('ireResendEmailVerification');
    Route::get('email-verify-check/{token}', [IreRegisterController::class, 'email_verify_check'])->name('ireEmailVerifyCheck');

    Route::middleware(['ireEmailVerify'])->group(function () {
        ############################### IREs English Routes ###################################
        Route::get('ire-registration-details', [IreRegisterController::class, 'ire_register_details_view'])->name('ireRegisterDetails');
        Route::post('ire-registration-details', [IreRegisterController::class, 'ire_register_details']);
        Route::get('ar-ire-registration-details', [IreRegisterController::class, 'ire_register_details_arabic_view'])->name('ireRegisterDetailsArabic');

        Route::middleware(['ireRegisterDetails'])->group(function () {
            Route::get('ire-dashboard', [IreController::class, 'dashboard'])->name('ireDashboard');
            Route::get('ire-profile', [IreController::class, 'profile'])->name('ireProfile');
            Route::get('ire-change-password', [IreController::class, 'change_password_view'])->name('ireChangePassword');
            Route::post('ire-change-password', [IreController::class, 'change_password']);
            Route::get('ire-references', [IreController::class, 'reference'])->name('ireReference');
            Route::get('ire-incomplete-references', [IreController::class, 'incomplete_reference'])->name('ireIncompleteReference');
            Route::get('ire-payments', [IreController::class, 'payment'])->name('irePayment');
            Route::get('ire-downloads', [IreController::class, 'download'])->name('ireDownload');
            Route::get('download-file/{id}', [IreController::class, 'download_file'])->name('ireDownloadFile');

            ########################### IREs Arabic Routes #######################################
            Route::get('ar-ire-dashboard', [IreController::class, 'arabic_dashboard'])->name('ireArabicDashboard');
            Route::get('ar-ire-profile', [IreController::class, 'arabic_profile'])->name('ireArabicProfile');
            Route::get('ar-ire-change-password', [IreController::class, 'arabic_change_password_view'])->name('ireArabicChangePassword');
            Route::get('ar-ire-references', [IreController::class, 'arabic_reference'])->name('ireArabicReference');
            Route::get('ar-ire-incomplete-references', [IreController::class, 'arabic_incomplete_reference'])->name('ireArabicIncompleteReference');
            Route::get('ar-ire-payments', [IreController::class, 'arabic_payment'])->name('ireArabicPayment');
            Route::get('ar-ire-downloads', [IreController::class, 'arabic_download'])->name('ireArabicDownload');
        });
    });
});
############################################################## END ##########################################################################


Route::get('/testOne', function () {
//    $user = \App\Models\User::find(5);
//    $business = \App\Models\Business::find(1);

//    $rating = $business->rating([
//        'title' => 'This is a test title',
//        'body' => 'And we will add some shit here',
//        'customer_service_rating' => 0,
//        'quality_rating' => 0,
//        'friendly_rating' => 0,
//        'pricing_rating' => 0,
//        'rating' => 1,
//        'recommend' => 'Yes',
//        'approved' => true, // This is optional and defaults to false
//    ], $business);
//    $ratings = $business->getAllRatings($business->id, 'desc');
//    dd($business->averageRating());

});


