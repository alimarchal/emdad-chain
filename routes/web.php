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
use App\Http\Controllers\IreController;
use App\Http\Controllers\IreLoginController;
use App\Http\Controllers\IreRegisterController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlacedRFQController;
use App\Http\Controllers\POInfoController;
use App\Http\Controllers\PurchaseRequestFormController;
use App\Http\Controllers\QouteController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentCartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WebsiteArabicController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LibraryController;


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



Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::middleware(['auth:sanctum', 'verified'])->post('languageChange', [DashboardController::class, 'languageChange'])->name('languageChange');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChange/{lang}/{rtl_value}', [DashboardController::class, 'languageChange'])->name('languageChange');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChangeForPayment/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForPayment'])->name('languageChangeForPayment');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChangeForPackagePayment/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForPackagePayment'])->name('languageChangeForPackagePayment');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChangeForIREEdit/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForIREEdit'])->name('languageChangeForIREEdit');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChangeForCommissionPercentage/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForCommissionPercentage'])->name('languageChangeForCommissionPercentage');
Route::middleware(['auth:sanctum', 'verified'])->get('languageChangeForDownloadableFiles/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForDownloadableFiles'])->name('languageChangeForDownloadableFiles');
Route::middleware(['auth:sanctum'])->resource('users', UserController::class);
Route::middleware(['auth:sanctum'])->post('/registrationType', [UserController::class, 'registrationType']);
// User Log route for SuperAdmin
Route::middleware(['auth:sanctum'])->get('/user-logs', [UserController::class, 'user_log'])->name('user_logs');

// Adding National Id Card photo
Route::middleware(['auth:sanctum', 'verified'])->post('national-id-card-image/{user_id}', [UserController::class, 'nationalIdCardPhoto'])->name('nationalIdCardPhoto');

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

// Update business certificate route for Users
Route::middleware(['auth:sanctum'])->get('/update-certificates/', [BusinessController::class, 'certificateView'])->name('certificateView');
Route::middleware(['auth:sanctum'])->post('/update-certificates/', [BusinessController::class, 'certificateUpdate']);

// Update business certificate route for Emdad users
Route::middleware(['auth:sanctum'])->get('/certificates-update-requests/', [BusinessController::class, 'certificates'])->name('certificates');
Route::middleware(['auth:sanctum'])->get('/certificates-show/{id}', [BusinessController::class, 'certificateShow'])->name('certificateShow');
Route::middleware(['auth:sanctum'])->get('/certificates-status-update/{id}/{status}', [BusinessController::class, 'certificateStatusUpdate'])->name('certificateStatusUpdate');
Route::middleware(['auth:sanctum'])->get('/business-certificates-update/{id}', [BusinessController::class, 'certificateBusinessStatusUpdate'])->name('certificateBusinessStatusUpdate');

Route::middleware(['auth:sanctum'])->get('/incomplete-business-registration/', [BusinessController::class, 'incomplete'])->name('incompleteBusiness');
Route::middleware(['auth:sanctum'])->get('/business-status/', [BusinessController::class, 'accountStatus'])->name('accountStatus');
Route::middleware(['auth:sanctum'])->get('/business-legal-finance-status/', [BusinessController::class, 'businessLegalFinanceStatus'])->name('businessLegalFinanceStatus');

Route::middleware(['auth:sanctum'])->resource('/businessFinanceDetail', \App\Http\Controllers\BusinessFinanceDetailController::class);
Route::middleware(['auth:sanctum'])->get('/businessWarehouse/number-update', [BusinessWarehouseController::class, 'updateNumber'])->name('warehouseNumberUpdate');
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
Route::get('/en-suppliers', [\App\Http\Controllers\WebsiteEnglishController::class, 'suppliers'])->name('english.suppliers');
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
Route::get('/ar-suppliers', [WebsiteArabicController::class, 'suppliers'])->name('arabic.suppliers');
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
Route::get('/register/{lang}', function ($lang) {
    App::setlocale($lang);
    return view('auth.registerAr');
})->name('registerAr');
Route::get('/login/{lang}', function ($lang) {
    App::setlocale($lang);
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
Route::middleware(['auth:sanctum'])->get('rfq-view', [PurchaseRequestFormController::class, 'view'])->name('rfqView');
Route::middleware(['auth:sanctum'])->resource('RFQ', PurchaseRequestFormController::class);

// For Single Category RFQ
Route::middleware(['auth:sanctum'])->get('create-single-category-rfq', [PurchaseRequestFormController::class, 'create_single_rfq'])->name('create_single_rfq');
Route::middleware(['auth:sanctum'])->post('create-single-category-rfq', [PurchaseRequestFormController::class, 'store_single_rfq']);
Route::middleware(['auth:sanctum'])->resource('RFQCart', ECartController::class);

// For Single Category RFQ
Route::middleware(['auth:sanctum'])->get('single-category-cart', [ECartController::class, 'single_cart_index'])->name('single_cart_index');
Route::middleware(['auth:sanctum'])->post('store-single-category-cart-rfq', [ECartController::class, 'single_cart_store_rfq'])->name('single_cart_store_rfq');
Route::middleware(['auth:sanctum'])->post('delete-single-category-rfq/{id}', [ECartController::class, 'single_cart_destroy'])->name('single_cart_destroy');
Route::middleware(['auth:sanctum'])->resource('EOrders', EOrdersController::class);

// For Single Category RFQ
Route::middleware(['auth:sanctum'])->post('store-single-category-rfq', [EOrdersController::class, 'single_category_store'])->name('single_category_store');
Route::middleware(['auth:sanctum'])->resource('PlacedRFQ', PlacedRFQController::class);

// For Single category RFQ
Route::middleware(['auth:sanctum'])->get('placed-single-category-rfq', [PlacedRFQController::class, 'single_category_rfq_index'])->name('single_category_rfq_index');
Route::middleware(['auth:sanctum'])->get('single-category-rfq/{id}', [PlacedRFQController::class, 'single_category_rfq_view'])->name('single_category_rfq_view');

Route::get('/rfq-with-no-quotations', [PlacedRFQController::class, 'RFQsWithNoQuotations'])->name('RFQsWithNoQuotations');
Route::post('/change-company-check', [ECartController::class, 'companyCheck'])->name('companyCheck');
#########################################################################
Route::middleware(['auth:sanctum'])->get('/RFQPlacedItems/{EOrderItems}', [PlacedRFQController::class, 'RFQItems'])->name('RFQItemsByID');
Route::middleware(['auth:sanctum'])->get('/viewRFQs', [PlacedRFQController::class, 'viewRFQs'])->name('viewRFQs');
Route::middleware(['auth:sanctum'])->get('/viewRFQs/{eOrderItems}', [PlacedRFQController::class, 'viewRFQsID'])->name('viewRFQsID');
Route::middleware(['auth:sanctum'])->get('/rejectRFQ/{eOrderID}', [PlacedRFQController::class, 'rejectRFQ'])->name('rejectRFQ');
Route::middleware(['auth:sanctum'])->get('/single-category-RFQs', [PlacedRFQController::class, 'viewSingleCategoryRFQs'])->name('singleCategoryRFQs');
//Route::middleware(['auth:sanctum'])->get('/view-RFQs-for-single-category-{eOrderID}', [PlacedRFQController::class, 'viewRFQsOfSingleCategory'])->name('viewRFQsOfSingleCategory');
//Route::middleware(['auth:sanctum'])->get('/quote-RFQs-for-single-category-{eOrderItems}', [PlacedRFQController::class, 'viewSingleCategoryRFQByID'])->name('viewSingleCategoryRFQByID');
Route::middleware(['auth:sanctum'])->get('/quote-RFQs-for-single-category-{eOrder}', [PlacedRFQController::class, 'viewSingleCategoryRFQByID'])->name('viewSingleCategoryRFQByID');
Route::middleware(['auth:sanctum'])->get('/modification-needed-quote-RFQs-for-single-category-{quote}', [PlacedRFQController::class, 'viewModifiedSingleCategoryRFQByID'])->name('viewModifiedSingleCategoryRFQByID');
Route::middleware(['auth:sanctum'])->get('/RFQsQouted', [PlacedRFQController::class, 'RFQsQouted'])->name('RFQsQouted');

/* Generating PDF file for Multi Category Quotation Supplier quoted. */
Route::middleware(['auth:sanctum'])->get('/generate-pdf/{eOrderItemID}', [PlacedRFQController::class, 'quotedQuotationPDF'])->name('PDFForQuotation');

#################### Roles display and update ##########################
Route::resource('/role', RoleController::class);
//Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'show'])->name('roles');
//>>>>>>>>>>>>>>>This is Permission Route<<<<<<<<<<<<<<<<<<<<<<<
Route::resource('/permission', PermissionController::class);
#################### END ##########################
//>>>>>>This is Business information rout to check status of business <<<<<<<<<<<<<<<<
Route::get('business/Approval/Update/{id}', [BusinessController::class, 'businessApprovalUpdate'])->name('businessApprovalUpdate');
Route::get('business/Approval/Rejected/{id}', [BusinessController::class, 'businessApprovalRejected'])->name('businessApprovalRejected');
Route::middleware(['auth:sanctum'])->post('single-quote-store', [QouteController::class, 'singleRFQQuotationStore'])->name('singleRFQQuotationStore');
Route::middleware(['auth:sanctum'])->post('single-quote-update', [QouteController::class, 'singleRFQQuotationUpdate'])->name('singleRFQQuotationUpdate');
Route::middleware(['auth:sanctum'])->resource('qoute', QouteController::class);
/* Calculating totalCost at the time of Supplier RFQ response */
Route::middleware(['auth:sanctum'])->get('total-cost', [QouteController::class, 'totalCost'])->name('totalCost');
/* Calculating totalCost for single category RFQ Type at the time of Supplier RFQ response */
Route::middleware(['auth:sanctum'])->get('single-total-cost', [QouteController::class, 'singleTotalCost'])->name('singleTotalCost');

Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/Qouted', [QouteController::class, 'QoutedRFQQouted'])->name('QoutedRFQQouted');
Route::middleware(['auth:sanctum'])->get('/Quoted/Modified/RFQs', [QouteController::class, 'QuotedModifiedRFQ'])->name('QuotedModifiedRFQ');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/Rejected', [QouteController::class, 'QoutedRFQRejected'])->name('QoutedRFQRejected');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/ModificationNeeded', [QouteController::class, 'QoutedRFQModificationNeeded'])->name('QoutedRFQModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/PendingConfirmation', [QouteController::class, 'QoutedRFQQoutedRFQPendingConfirmation'])->name('QoutedRFQPendingConfirmation');
Route::middleware(['auth:sanctum'])->get('/QoutedRFQ/Expired', [QouteController::class, 'QoutedRFQQoutedExpired'])->name('QoutedRFQQoutedExpired');

######################## Single Category RFQ routes For Supplier ############################################
Route::middleware(['auth:sanctum'])->get('/single/category/quoted-RFQs', [QouteController::class, 'singleCategoryQuotedRFQQuoted'])->name('singleCategoryQuotedRFQQuoted');
Route::middleware(['auth:sanctum'])->get('/single/category/quoted/modified/RFQs', [QouteController::class, 'singleCategoryQuotedModifiedRFQ'])->name('singleCategoryQuotedModifiedRFQ');
Route::middleware(['auth:sanctum'])->get('/single/category/rejected-RFQs', [QouteController::class, 'singleCategoryQuotedRFQRejected'])->name('singleCategoryQuotedRFQRejected');
Route::middleware(['auth:sanctum'])->get('/single/category/modification/needed/RFQs', [QouteController::class, 'singleCategoryQuotedRFQModificationNeeded'])->name('singleCategoryQuotedRFQModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/single/category/pending/confirmation/RFQs', [QouteController::class, 'singleCategoryQuotedRFQPendingConfirmation'])->name('singleCategoryQuotedRFQPendingConfirmation');
Route::middleware(['auth:sanctum'])->get('/single/category/expired/RFQs', [QouteController::class, 'singleCategoryRFQExpired'])->name('singleCategoryRFQExpired');

/* Generating PDF file for Single Category Quotation Supplier quoted */
Route::middleware(['auth:sanctum'])->get('/generate-single-category-quotation-pdf/{quoteID}/{eOrderItemID}', [PlacedRFQController::class, 'singleCategoryQuotedQuotationPDF'])->name('PDFForSingleCategoryQuotation');
#############################################################################################################

Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived', [QouteController::class, 'QoutationsBuyerReceived'])->name('QoutationsBuyerReceived');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/{QouteItem}', [QouteController::class, 'QoutationsBuyerReceivedQouteID'])->name('QoutationsBuyerReceivedQouteID');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderItems}', [QouteController::class, 'QoutationsBuyerReceivedRFQItemsByID'])->name('QoutationsBuyerReceivedRFQItemsByID');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/qoutes/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedQoutes'])->name('QoutationsBuyerReceivedQoutes');
Route::middleware(['auth:sanctum'])->get('/QuotationResetTime/{EOrderItemID}/', [QouteController::class, 'resetQuotationTime'])->name('resetQuotationTime');
Route::middleware(['auth:sanctum'])->get('/QuotationDiscard/{EOrderID}/', [QouteController::class, 'discardQuotation'])->name('discardQuotation');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/rejected/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedRejected'])->name('QoutationsBuyerReceivedRejected');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/modification/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedModificationNeeded'])->name('QoutationsBuyerReceivedModificationNeeded');
Route::middleware(['auth:sanctum'])->get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/accepted/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedAccepted'])->name('QoutationsBuyerReceivedAccepted');
Route::middleware(['auth:sanctum'])->get('/Quotation/expired/status/{quoteID}', [QouteController::class, 'quotationExpiredStatusUpdate'])->name('QuotationExpiredStatusUpdate');
Route::middleware(['auth:sanctum'])->post('/Quotation/expired/response/', [QouteController::class, 'quotationExpiredStatusResponse'])->name('QuotationExpiredStatusResponse');
Route::middleware(['auth:sanctum'])->get('/Quotation/expired/reject/response/{quoteID}', [QouteController::class, 'quotationExpiredStatusRejectResponse'])->name('quotationExpiredStatusRejectResponse');
Route::middleware(['auth:sanctum'])->get('/single/category/quotation/expired/status/{quoteEOrderID}/{supplierBusinessID}', [QouteController::class, 'quotationExpiredStatusUpdateSingleCategory'])->name('quotationExpiredStatusUpdateSingleCategory');
Route::middleware(['auth:sanctum'])->post('/single/category/quotation/expired/response/', [QouteController::class, 'quotationExpiredStatusResponseSingleCategory'])->name('quotationExpiredStatusResponseSingleCategory');
Route::middleware(['auth:sanctum'])->get('/single/category/quotation/expired/reject/response/{quoteEOrderID}', [QouteController::class, 'quotationExpiredStatusRejectResponseSingleCategory'])->name('quotationExpiredStatusRejectResponseSingleCategory');

/* Generating PDF file for Multi Category Quotation buyer received */
Route::middleware(['auth:sanctum'])->get('generate-quotation-pdf/{quote_supplier_business_id}/{e_order_id}', [QouteController::class, 'quotationPDF'])->name('quotationPDF');

######################## Single Category Quotations routes For Buyer ############################################
Route::middleware(['auth:sanctum'])->get('/single/category/rfq', [QouteController::class, 'singleCategoryBuyerRFQs'])->name('singleCategoryBuyerRFQs');
Route::middleware(['auth:sanctum'])->get('/single/category/rfq/items/{rfq_id}', [QouteController::class, 'singleCategoryRFQItems'])->name('singleCategoryRFQItems');
Route::middleware(['auth:sanctum'])->get('/single/category/rfq/item/response/{quote}', [QouteController::class, 'singleCategoryRFQItemByID'])->name('singleCategoryRFQItemByID');
Route::middleware(['auth:sanctum'])->get('/single/category/RFQ/quotations/{eOrderID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsBuyerReceived'])->name('singleCategoryRFQQuotationsBuyerReceived');
Route::middleware(['auth:sanctum'])->get('/SingleCategoryQuotationResetTime/{eOrderID}/', [QouteController::class, 'resetSingleCategoryQuotationTime'])->name('resetSingleCategoryQuotationTime');
Route::middleware(['auth:sanctum'])->get('/SingleCategoryQuotationDiscard/{eOrderID}/', [QouteController::class, 'discardSingleCategoryQuotation'])->name('discardSingleCategoryQuotation');
Route::middleware(['auth:sanctum'])->get('/single/category/RFQ/rejected/quotations/{EOrderItemID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsBuyerRejected'])->name('singleCategoryRFQQuotationsBuyerRejected');
Route::middleware(['auth:sanctum'])->get('/single/category/RFQ/modification/quotations/{eOrderID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsModificationNeeded'])->name('singleCategoryRFQQuotationsModificationNeeded');
Route::middleware(['auth:sanctum'])->post('single-rfq-quote/{quotes}/ModificationNeeded', [QouteController::class, 'singleCategoryRFQUpdateStatusModificationNeeded'])->name('singleCategoryRFQUpdateStatusModificationNeeded');
Route::middleware(['auth:sanctum'])->get('single-rfq-quote/{quotes}/Rejected', [QouteController::class, 'singleCategoryRFQUpdateStatusRejected'])->name('singleCategoryRFQUpdateStatusRejected');
Route::middleware(['auth:sanctum'])->post('singleCategoryQuote/Accepted', [QouteController::class, 'singleCategoryQuoteAccepted'])->name('singleCategoryQuoteAccepted');

/* Generating PDF file for Single Category Quotation buyer received */
Route::middleware(['auth:sanctum'])->get('single-rfq-quotation-pdf/{quote_supplier_business_id}/{e_order_id}', [QouteController::class, 'singleCategoryQuotationPDF'])->name('singleCategoryQuotationPDF');
#################################################################################################################


Route::middleware(['auth:sanctum'])->resource('QuotationMessage', \App\Http\Controllers\QouteMessageController::class);
Route::middleware(['auth:sanctum'])->post('qoute/{qoute}/ModificationNeeded', [QouteController::class, 'updateModificationNeeded'])->name('updateQoute');
Route::middleware(['auth:sanctum'])->get('qoute/{qoute}/Rejected', [QouteController::class, 'updateRejected'])->name('updateRejected');
Route::middleware(['auth:sanctum'])->post('qoute/{qoute}/Accepted', [QouteController::class, 'qouteAccepted'])->name('qouteAccepted');
Route::middleware(['auth:sanctum'])->get('/purchase-order', [DraftPurchaseOrderController::class, 'view'])->name('purchaseOrderView');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'show'])->name('dpo.show');
Route::middleware(['auth:sanctum'])->get('dpo', [DraftPurchaseOrderController::class, 'index'])->name('dpo.index');
Route::middleware(['auth:sanctum'])->get('/Quotation/expired/status/DPO/{quoteID}', [DraftPurchaseOrderController::class, 'quotationExpiredStatusUpdate'])->name('DPOExpiredStatusUpdate');
Route::middleware(['auth:sanctum'])->get('/Quotation/expired/status/reject/DPO/{quoteID}', [DraftPurchaseOrderController::class, 'quotationExpiredReject'])->name('DPOExpiredStatusReject');
Route::middleware(['auth:sanctum'])->get('/single/category/DPO/quotation/expired/status/{quoteEOrderID}', [DraftPurchaseOrderController::class, 'quotationExpiredStatusUpdateSingleCategory'])->name('DPOExpiredStatusUpdateSingleCategory');
##################################### Single Category DPO #######################################################
Route::middleware(['auth:sanctum'])->get('single/category/dpo', [DraftPurchaseOrderController::class, 'singleCategoryDPOIndex'])->name('singleCategoryDPOIndex');
Route::middleware(['auth:sanctum'])->post('single-category-dpo/file-upload', [DraftPurchaseOrderController::class, 'uploadSingleCategoryDPOFile'])->name('uploadSingleCategoryDPOFile');
Route::middleware(['auth:sanctum'])->get('single/category/dpo-{eOrderID}', [DraftPurchaseOrderController::class, 'singleCategoryDPOShow'])->name('singleCategoryDPOShow');
Route::middleware(['auth:sanctum'])->post('single/category/dpo/approved/{rfqNo}/{supplierBusinessID}', [DraftPurchaseOrderController::class, 'singleCategoryApproved'])->name('singleCategoryApproved');
Route::middleware(['auth:sanctum'])->post('single/category/dpo/cancel/{rfqNo}/{supplierBusinessID}', [DraftPurchaseOrderController::class, 'singleCategoryCancel'])->name('singleCategoryCancel');
#################################################################################################################
Route::middleware(['auth:sanctum'])->post('dpo/file-upload', [DraftPurchaseOrderController::class, 'uploadDPOFile'])->name('uploadDPOFile');
Route::middleware(['auth:sanctum'])->post('dpo/{draftPurchaseOrder}/approved', [DraftPurchaseOrderController::class, 'approved'])->name('dpo.approved');
Route::middleware(['auth:sanctum'])->post('cash/dpo/{draftPurchaseOrder}/approved', [DraftPurchaseOrderController::class, 'approved'])->name('cashDpo.approved');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}/rejected', [DraftPurchaseOrderController::class, 'rejected'])->name('dpo.rejected');
Route::middleware(['auth:sanctum'])->get('dpo/{draftPurchaseOrder}/cancel', [DraftPurchaseOrderController::class, 'cancel'])->name('dpo.cancel');


#################### PDF generate Routes ##########################
Route::middleware(['auth:sanctum'])->get('/generate-PO-pdf/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'generatePDF'])->name('generatePDF');
Route::middleware(['auth:sanctum'])->post('/single/category/generate/PO/pdf/{rfqNO}', [DraftPurchaseOrderController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryGeneratePDF');
#################### END ##########################################

#################### PDF generate Routes ##########################
Route::middleware(['auth:sanctum'])->get('/logviewer', function () {
    return redirect('admin/logviewer');
})->name('log.viewer');
#################### END ##########################################

#################### Delivery and Delivery Note ###################################################################################
Route::middleware(['auth:sanctum'])->get('deliveries', [DeliveryNoteController::class, 'view'])->name('deliveryView');
Route::middleware(['auth:sanctum'])->get('delivery-details/{rfq_no}/{deliveryID}/{rfq_type}', [DeliveryController::class, 'show'])->name('deliveryDetails');
Route::middleware(['auth:sanctum'])->get('delivery-note-pdf/{deliveryID}/{rfq_no}/{rfq_type}/', [DeliveryController::class, 'pdf'])->name('deliveryNotePDF');
Route::middleware(['auth:sanctum'])->get('/deliveryNote/{draftPurchaseOrder}/view', [DeliveryNoteController::class, 'deliveryNoteView'])->name('deliveryNoteView');
Route::middleware(['auth:sanctum'])->resource('deliveryNote', DeliveryNoteController::class);
Route::middleware(['auth:sanctum'])->get('/generate-delivery-note-pdf/{deliveryNote}', [DeliveryNoteController::class, 'generatePDF'])->name('generateDeliveryNotePDF');

##################### Single Category RFQ Delivery and Delivery Note routes ####################################
Route::middleware(['auth:sanctum'])->get('/single/category/delivery/notes', [DeliveryNoteController::class, 'singleCategoryIndex'])->name('singleCategoryIndex');
Route::middleware(['auth:sanctum'])->get('/single/category/deliveryNote/{rfqNo}/view', [DeliveryNoteController::class, 'singleCategoryDeliveryNoteView'])->name('singleCategoryDeliveryNoteView');
Route::middleware(['auth:sanctum'])->post('/single/category/deliveryNote/{rfqNo}/save', [DeliveryNoteController::class, 'singleCategoryStore'])->name('singleCategoryDeliveryNoteStore');
Route::middleware(['auth:sanctum'])->get('/generate-single-category-delivery-note-pdf/{deliveryNoteRfqNo}', [DeliveryNoteController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryDeliveryNoteGeneratePDF');
################################### END ########################################################################

#################### END ###########################################################################################################

############################################################# Draft purchase order routes ####################################
Route::middleware(['auth:sanctum'])->get('/po', [DraftPurchaseOrderController::class, 'po'])->name('po.po');
Route::middleware(['auth:sanctum'])->get('/po/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'poShow'])->name('po.show');
Route::middleware(['auth:sanctum'])->get('/notes', [DeliveryNoteController::class, 'notes'])->name('notes');
Route::middleware(['auth:sanctum'])->get('/notes/{deliveryNote}', [DeliveryNoteController::class, 'viewNote'])->name('viewNote');

##################### Single Category RFQ PO routes ####################################
Route::middleware(['auth:sanctum'])->get('/single/category/po', [DraftPurchaseOrderController::class, 'singleCategoryPO'])->name('singleCategoryPO');
Route::middleware(['auth:sanctum'])->get('/single/category/po/{rfqNo}', [DraftPurchaseOrderController::class, 'singleCategoryPOShow'])->name('singleCategoryPOByID');
Route::middleware(['auth:sanctum'])->get('/single/category/notes', [DeliveryNoteController::class, 'singleCategoryNotes'])->name('singleCategoryNotes');
Route::middleware(['auth:sanctum'])->get('/single/category/notes/{rfq_no}', [DeliveryNoteController::class, 'singleCategoryViewNote'])->name('singleCategoryViewNote');
################################### END ################################################

################################################################## END ##################################################

##################### Shipment routes ####################################
Route::middleware(['auth:sanctum'])->resource('shipment', ShipmentController::class);
Route::middleware(['auth:sanctum'])->resource('shipmentCart', ShipmentCartController::class);
Route::middleware(['auth:sanctum'])->resource('shipmentItem', ShipmentItemController::class);
Route::middleware(['auth:sanctum'])->get('delivered-shipments', [ShipmentController::class, 'delivered'])->name('deliveredShipments');
Route::middleware(['auth:sanctum'])->get('ongoing-shipments', [ShipmentController::class, 'ongoingShipment'])->name('ongoingShipment');
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
Route::middleware(['auth:sanctum'])->get('/generate-emdad-invoice-pdf/{emdadInvoiceID}', [EmdadInvoiceController::class, 'generatePDF'])->name('generateEmdadInvoicePDF');

########################## Single Category Invoice & Delivery Routes ####################
Route::middleware(['auth:sanctum'])->get('single/category/invoice/{invoiceID}', [InvoiceController::class, 'singleCategoryShow'])->name('singleCategoryInvoiceShow');
Route::middleware(['auth:sanctum'])->post('single/category/invoice/generate', [InvoiceController::class, 'singleCategoryInvoiceGenerate'])->name('singleCategoryInvoiceGenerate');
Route::middleware(['auth:sanctum'])->get('/single/category/emdad-invoices/', [EmdadInvoiceController::class, 'singleCategoryIndex'])->name('singleCategoryEmdadInvoicesIndex');
Route::middleware(['auth:sanctum'])->get('/single/category/emdad-invoice/{rfq_no}', [EmdadInvoiceController::class, 'singleCategoryView'])->name('singleCategoryView');
Route::middleware(['auth:sanctum'])->post('/single/category/generate-emdad-invoice', [EmdadInvoiceController::class, 'singleCategoryGenerateInvoice'])->name('singleCategoryGenerateInvoice');
Route::middleware(['auth:sanctum'])->get('/generate-single-category-emdad-invoice-pdf/{emdadInvoiceRFQNo}', [EmdadInvoiceController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryEmadadInvoiceGeneratePDF');
#################### END ##############################################################

########################################################## Payment routes #################################################################################
Route::middleware(['auth:sanctum'])->get('payments', [PaymentController::class, 'view'])->name('paymentView');
Route::middleware(['auth:sanctum'])->resource('payment', PaymentController::class);
Route::middleware(['auth:sanctum'])->get('generate-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoiceView'])->name('generateProformaView');
Route::middleware(['auth:sanctum'])->get('create-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoice'])->name('generateProforma');
Route::middleware(['auth:sanctum'])->get('invoices-history', [PaymentController::class, 'invoices'])->name('invoices');
Route::middleware(['auth:sanctum'])->get('emdad-invoices-history', [PaymentController::class, 'payments'])->name('emdad_payments');
Route::middleware(['auth:sanctum'])->get('supplier-manual-payments', [PaymentController::class, 'supplier_payment'])->name('supplier_payment');
Route::middleware(['auth:sanctum'])->get('manual-payments', [PaymentController::class, 'supplier_payment_received'])->name('supplier_payment_received');
Route::middleware(['auth:sanctum'])->get('invoice-details/{id}', [PaymentController::class, 'invoiceView'])->name('invoiceView');
Route::middleware(['auth:sanctum'])->get('proforma-invoices', [PaymentController::class, 'proforma_invoices'])->name('proforma_invoices');
Route::middleware(['auth:sanctum'])->get('generate-proforma-invoice', [PaymentController::class, 'generate_proforma_invoice'])->name('generate_proforma_invoices');
Route::middleware(['auth:sanctum'])->get('emdad-supplier-manual-payment-show/{id}', [BankPaymentController::class, 'admin_supplier_payment_view'])->name('admin_supplier_payment_view');
Route::middleware(['auth:sanctum'])->get('supplier-manual-payment-show/{id}', [BankPaymentController::class, 'supplier_payment_view'])->name('supplier_payment_view');
Route::middleware(['auth:sanctum'])->post('supplier-manual-payment-update/{id}', [BankPaymentController::class, 'update_bank_payment'])->name('update_bank_payment');
Route::middleware(['auth:sanctum'])->post('update-supplier-manual-payment/{id}', [BankPaymentController::class, 'update_supplier_payment_status'])->name('update_supplier_payment_status');
Route::middleware(['auth:sanctum'])->resource('bank-payments', BankPaymentController::class)->names('bank-payments');
Route::middleware(['auth:sanctum'])->get('bank-payments/{invoice}/create', [BankPaymentController::class, 'create'])->name('bank-payments.create');
Route::middleware(['auth:sanctum'])->get('bank-payments/{invoice}/edit', [BankPaymentController::class, 'edit'])->name('bank-payments.edit');
Route::middleware(['auth:sanctum'])->post('bank-payments/update', [BankPaymentController::class, 'update_payment'])->name('bank_payments_update');
//Route::middleware(['auth:sanctum'])->resource('moyasar-payment', Moyas::class)->names('mps');
Route::middleware(['auth:sanctum'])->get('/generate-invoice-pdf/{invoiceID}', [PaymentController::class, 'generatePDF'])->name('generateInvoicePDF');

####################### Single Category Quotation Payment routes ####################################
Route::middleware(['auth:sanctum'])->get('single-category-rfq-payment', [PaymentController::class, 'singleCategoryIndex'])->name('singleCategoryPaymentIndex');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-proforma-invoice', [PaymentController::class, 'singleCategoryGenerateProformaInvoiceView'])->name('singleCategoryGenerateProformaInvoiceView');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-generate-proforma-invoice/{rfqNo}', [PaymentController::class, 'singleCategoryGenerateProformaInvoice'])->name('singleCategoryGenerateProformaInvoice');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-proforma-invoices', [PaymentController::class, 'singleCategoryProformaInvoices'])->name('singleCategoryProformaInvoices');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-invoice-details/{rfq_no}', [PaymentController::class, 'singleCategoryInvoiceView'])->name('singleCategoryInvoiceView');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-bank-payments/{rfq_no}/create', [BankPaymentController::class, 'singleCategoryCreate'])->name('singleCategoryBankPaymentCreate');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-bank-payments/{id}/edit', [BankPaymentController::class, 'singleCategoryEdit'])->name('singleCategoryBankPaymentEdit');
Route::middleware(['auth:sanctum'])->post('single-category-rfq-bank-payment-store', [BankPaymentController::class, 'singleCategoryStore'])->name('singleCategoryStore');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-emdad-invoices-history', [PaymentController::class, 'singleCategoryPayments'])->name('singleCategoryPayments');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-bank-payment/{id}', [BankPaymentController::class, 'singleCategoryShow'])->name('singleCategoryShow');
Route::middleware(['auth:sanctum'])->post('single-category-rfq-bank-payment-update/{rfq_no}', [BankPaymentController::class, 'singleCategoryUpdate'])->name('singleCategoryBankPaymentUpdate');
Route::middleware(['auth:sanctum'])->post('single-category-rfq-bank-payments/update/bank-payment/{rfq_no}', [BankPaymentController::class, 'singleUpdatePayment'])->name('singleCategoryBankPaymentBuyerUpdate');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-invoices-history', [PaymentController::class, 'singleCategoryInvoices'])->name('singleCategoryInvoices');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-unpaid-bank-payments', [BankPaymentController::class, 'singleCategoryIndex'])->name('singleCategoryBankPaymentIndex');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-manual-payments', [PaymentController::class, 'singleCategorySupplierPaymentsReceived'])->name('singleCategorySupplierPaymentsReceived');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-emdad-supplier-manual-payments', [PaymentController::class, 'singleCategorySupplierPayment'])->name('singleCategorySupplierPayment');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-emdad-supplier-manual-payment/{rfq_no}', [BankPaymentController::class, 'singleCategoryAdminSupplierPaymentView'])->name('singleCategoryAdminSupplierPaymentView');
Route::middleware(['auth:sanctum'])->post('single-category-rfq-emdad-update-supplier-manual-payment/{rfqNo}', [BankPaymentController::class, 'singleCategoryUpdateSupplierPaymentStatus'])->name('singleCategoryUpdateSupplierPaymentStatus');
Route::middleware(['auth:sanctum'])->get('single-category-rfq-supplier-manual-payment/{id}', [BankPaymentController::class, 'singleCategorySupplierPaymentView'])->name('singleCategorySupplierPaymentView');
Route::middleware(['auth:sanctum'])->post('single-category-rfq-supplier-manual-payment-update/{rfqNo}', [BankPaymentController::class, 'singleCategoryUpdateBankPayment'])->name('singleCategoryUpdateBankPayment');
Route::middleware(['auth:sanctum'])->get('/generate-single-category-invoice-pdf/{invoiceRfqNo}', [PaymentController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryInvoiceGeneratePDF');
################################################################### END ############################################################################################

################################################################# Rating routes ##########################################################################

/* Super admin rating routes starts */
Route::middleware(['auth:sanctum'])->get('rating-view', [RatingController::class, 'view'])->name('ratingView');
Route::middleware(['auth:sanctum'])->get('ratings-list', [RatingController::class, 'index'])->name('ratingListIndex');
Route::middleware(['auth:sanctum'])->get('ratings-received/{id}', [RatingController::class, 'viewByID'])->name('ratingViewByID');
Route::middleware(['auth:sanctum'])->get('emdad-ratings', [RatingController::class, 'emdadRated'])->name('emdadRated');
Route::middleware(['auth:sanctum'])->get('emdad-rated/{id}', [RatingController::class, 'emdadRatedViewByID'])->name('emdadRatedViewByID');
Route::middleware(['auth:sanctum'])->get('emdad-not-rated', [RatingController::class, 'emdadUnRated'])->name('emdadUnRated');
Route::middleware(['auth:sanctum'])->get('rated-buyers', [RatingController::class, 'buyerRated'])->name('buyerRated');
Route::middleware(['auth:sanctum'])->get('rated-suppliers', [RatingController::class, 'supplierRated'])->name('supplierRated');
Route::middleware(['auth:sanctum'])->get('rate', [RatingController::class, 'buyerList'])->name('buyerList');
Route::middleware(['auth:sanctum'])->get('rate-buyer/{id}/{deliveryID}', [RatingController::class, 'createBuyerRating'])->name('rateBuyer');
Route::middleware(['auth:sanctum'])->post('save-buyer-rating', [RatingController::class, 'saveBuyerRating'])->name('storeBuyerRating');
Route::middleware(['auth:sanctum'])->get('rate-supplier', [RatingController::class, 'supplierList'])->name('supplierList');
Route::middleware(['auth:sanctum'])->get('rate-supplier/{id}/{deliveryID}', [RatingController::class, 'createSupplierRating'])->name('rateSupplier');
Route::middleware(['auth:sanctum'])->post('save-supplier-rating', [RatingController::class, 'saveSupplierRating'])->name('storeSupplierRating');
/* Super admin rating routes ends */

/* Buyer rating routes starts */
Route::middleware(['auth:sanctum'])->get('rating', [RatingController::class, 'buyerRatingView'])->name('buyerRatingView');
Route::middleware(['auth:sanctum'])->get('deliveries-ratings', [RatingController::class, 'buyerDeliveryIndex'])->name('buyerDeliveryRatingListIndex');
Route::middleware(['auth:sanctum'])->get('delivery-ratings/{id}', [RatingController::class, 'buyerDeliveryViewByID'])->name('buyerDeliveryRatingViewByID');
Route::middleware(['auth:sanctum'])->get('buyer-rated', [RatingController::class, 'buyerRatedToDeliveries'])->name('buyerRatedToDeliveries');
Route::middleware(['auth:sanctum'])->get('buyer-rated/{id}', [RatingController::class, 'buyerRatedViewByID'])->name('buyerRatedViewByID');
Route::middleware(['auth:sanctum'])->get('buyer-not-rated', [RatingController::class, 'buyerUnRatedDeliveries'])->name('buyerUnRatedDeliveries');
Route::middleware(['auth:sanctum'])->get('rate-deliveries', [RatingController::class, 'deliveriesListToRate'])->name('deliveriesListToRate');
Route::middleware(['auth:sanctum'])->get('rate-delivery/{supplierID}/{driverID}/{deliveryID}', [RatingController::class, 'createDeliveryRating'])->name('rateDelivery');
Route::middleware(['auth:sanctum'])->post('save-buyer-rated', [RatingController::class, 'saveBuyerRatedToDelivery'])->name('storeBuyerRatedToDelivery');
/* Buyer rating routes ends */

/* Supplier rating routes starts */
Route::middleware(['auth:sanctum'])->get('ratings', [RatingController::class, 'supplierRatingView'])->name('supplierRatingView');
Route::middleware(['auth:sanctum'])->get('deliveries-rating', [RatingController::class, 'supplierDeliveryIndex'])->name('supplierDeliveryRatingListIndex');
Route::middleware(['auth:sanctum'])->get('delivery/ratings/{id}', [RatingController::class, 'supplierDeliveryViewByID'])->name('supplierDeliveryRatingViewByID');
Route::middleware(['auth:sanctum'])->get('supplier-rated', [RatingController::class, 'supplierRatedToDeliveries'])->name('supplierRatedToDeliveries');
Route::middleware(['auth:sanctum'])->get('supplier-rated/{id}', [RatingController::class, 'supplierRatedViewByID'])->name('supplierRatedViewByID');
Route::middleware(['auth:sanctum'])->get('supplier-not-rated', [RatingController::class, 'supplierUnRatedDeliveries'])->name('supplierUnRatedDeliveries');
Route::middleware(['auth:sanctum'])->get('deliveries-to-rate', [RatingController::class, 'supplierDeliveriesListToRate'])->name('supplierDeliveriesListToRate');
Route::middleware(['auth:sanctum'])->get('rate-delivery-by-supplier/{buyerID}/{deliveryID}', [RatingController::class, 'createDeliveryRatingBySupplier'])->name('rateDeliveryBySupplier');
Route::middleware(['auth:sanctum'])->post('save-supplier-rated', [RatingController::class, 'saveSupplierRatedToDelivery'])->name('storeSupplierRatedToDelivery');
/* Supplier rating routes ends */

################################################################# END ####################################################################################

####################### Subscription routes ####################################
// Route::middleware(['auth:sanctum'])->get('sub', function () {
//     return view('subscription.index');
// })->name('subscription');
#################### END ##############################################################

//Route::post('/make-payment', [\App\Http\Controllers\MakePaymentController::class, 'makePayment'])->name('make.payment');
//Route::get('/payment-status', [\App\Http\Controllers\MakePaymentController::class, 'paymentStatus'])->name('payment.status');
//return view('moyasar_payment.payment');


Route::post('/credit/step-one', [\App\Http\Controllers\MakePaymentController::class, 'getPaymentCheckOutId'])->name('getPaymentCheckOutId');
Route::post('/process-payment', [\App\Http\Controllers\MakePaymentController::class, 'processPayment'])->name('processPaymentCheckout');
Route::get('/process-payment-status', [\App\Http\Controllers\MakePaymentController::class, 'processPaymentStatus'])->name('processPaymentStatus');


Route::middleware(['auth:sanctum'])->get('subscription-update/{id}', [PackageController::class, 'update'])->name('subscriptionUpdate');
Route::middleware(['auth:sanctum'])->get('subscription-pdf', [PackageController::class, 'pdf'])->name('subscriptionPDF');
Route::middleware(['auth:sanctum'])->resource('packages', PackageController::class);
Route::middleware(['auth:sanctum'])->get('business-packages/status', [\App\Http\Controllers\BusinessPackageController::class, 'businessPackagePaymentStatus'])->name('businessPackage.paymentStatus');
Route::middleware(['auth:sanctum'])->post('business-packages/step-one', [\App\Http\Controllers\BusinessPackageController::class, 'getCheckOutId'])->name('businessPackage.stepOne');
Route::middleware(['auth:sanctum'])->resource('business-packages', BusinessPackageController::class);
/* Route for upgrading package */
Route::middleware(['auth:sanctum'])->post('subscription-store/', [BusinessPackageController::class, 'storeBusinessPackageUpgrade'])->name('storeBusinessPackageUpgrade');
Route::middleware(['auth:sanctum'])->get('subscription-payment-status/', [BusinessPackageController::class, 'businessPackageUpgradePaymentStatus'])->name('businessPackageUpgradePaymentStatus');

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
#invoice payment
Route::middleware(['auth:sanctum'])->post('invoice-payment/step-one', [\App\Http\Controllers\BusinessPackageController::class, 'getCheckOutId_InvoicePayment'])->name('invoicePayment.stepOne');
Route::middleware(['auth:sanctum'])->post('invoice-payment/proceed_payment', [\App\Http\Controllers\BusinessPackageController::class, 'proceed_payment'])->name('invoicePayment.proceed_payment');
Route::middleware(['auth:sanctum'])->get('invoice-payment/invoice_payment_status', [\App\Http\Controllers\BusinessPackageController::class, 'invoice_payment_status'])->name('invoice_payment_status');

############################################################## END ##########################################################################
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('showLibrary', [LibraryController::class,'showLibrary'])->name('showLibrary');
    Route::resource('library', LibraryController::class);

    Route::get('logistics-dashboard', [DashboardController::class, 'logistic_dashboard'])->name('logistics.dashboard');
    Route::get('logistics-setting', [DashboardController::class, 'logistic_setting'])->name('logistics.setting');
    Route::get('logisticsBusiness/create', [\App\Http\Controllers\LogisticsBusinessController::class, 'create'])->name('logistics.business');
    Route::post('logisticsBusiness', [\App\Http\Controllers\LogisticsBusinessController::class, 'store'])->name('logistics.store');
    Route::get('logisticsBusiness/{logisticsBusiness}/edit', [\App\Http\Controllers\LogisticsBusinessController::class, 'edit'])->name('logistics.edit');
    Route::put('logisticsBusiness/{logisticsBusiness}', [\App\Http\Controllers\LogisticsBusinessController::class, 'update'])->name('logistics.update');
    Route::get('logisticsBusiness', [\App\Http\Controllers\LogisticsBusinessController::class, 'index'])->name('logistics.index');
    Route::resource('packagingSolution', \App\Http\Controllers\PackagingSolutionController::class);
    Route::resource('storageSolution', \App\Http\Controllers\StorageSolutionController::class);
});


Route::get('tree', function () {
    $parentCategories = Category::where('parent_id', 0)->where('is_active',1)->orderBy('name', 'asc')->get();
    return view('test.combotree',compact('parentCategories'));
});

/*
Route::get('/testSms', function () {
    $x = \App\Models\User::send_otp('6633','923008169924');
    dd($x);
});
*/
