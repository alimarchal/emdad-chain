<?php

use App\Http\Controllers\AdminDownloadController;
use App\Http\Controllers\AdminIreController;
use App\Http\Controllers\BankPaymentController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessFinanceDetailController;
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
use App\Http\Controllers\MakePaymentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlacedRFQController;
use App\Http\Controllers\POInfoController;
use App\Http\Controllers\PurchaseRequestFormController;
use App\Http\Controllers\QouteController;
use App\Http\Controllers\QouteMessageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentCartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\SmsMessagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WebsiteArabicController;
use App\Http\Controllers\WebsiteEnglishController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LibraryController;
use Barryvdh\Snappy;

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

####################  Shipper Website Template   ###################
####################     WebsiteEnglish          ###################
Route::group([], function (){
    Route::get('/english', [WebsiteEnglishController::class, 'index'])->name('english.index');
    Route::get('/en-about', [WebsiteEnglishController::class, 'about'])->name('english.about');
    Route::get('/en-service', [WebsiteEnglishController::class, 'service'])->name('english.service');
    Route::get('/en-team', [WebsiteEnglishController::class, 'team'])->name('english.team');
    Route::get('/en-contact', [WebsiteEnglishController::class, 'contact'])->name('english.contact');
    Route::get('/en-survey', [WebsiteEnglishController::class, 'survey'])->name('english.survey');
    Route::get('/en-suppliers', [WebsiteEnglishController::class, 'suppliers'])->name('english.suppliers');
    Route::get('/en-buyer-survey', [WebsiteEnglishController::class, 'buyerSurvey'])->name('english.buyerSurvey');
    Route::get('/en-supplier-survey', [WebsiteEnglishController::class, 'supplierSurvey'])->name('english.supplierSurvey');
    Route::get('/en-buyer-package', [WebsiteEnglishController::class, 'buyerPackage'])->name('english.buyerPackage');
    Route::get('/en-supplier-package', [WebsiteEnglishController::class, 'supplierPackage'])->name('english.supplierPackage');
    Route::get('/en-faq', [WebsiteEnglishController::class, 'faq'])->name('english.faq');

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
    Route::get('/ar-faq', [WebsiteArabicController::class, 'faq'])->name('arabic.faq');

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

    ######## Old theme Route Start ########
    ####################  Website    ###################
    /*Route::get('/aboutUs', function () {
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
    #################### Old Survey Supplier ###################
    Route::get('/e-supplier/en', function () {
        return view('eBuyerSurvey.en.eSupplierSurvey');
    });
    Route::get('/e-supplier/ar', function () {
        return view('eBuyerSurvey.ar.eSupplierSurvey');
    });*/
    #################### END ###############################
    Route::post('e-buyer', [EBuyerSurveyAnswerController::class, 'store'])->name('eBuyerEn');
    ######## Old theme Route End ########

    Route::resource('contact', ContactController::class);
    #################### End Website ###################

    ####################  Website AR    ###################
    Route::get('/en', function () {
        return redirect()->route('arabic.index');
    })->name('ar');
    Route::get('/register/{lang}', function ($lang) {
        App::setlocale($lang);
        return view('auth.registerAr');
    })->name('registerAr');
    Route::get('/login/{lang}', function ($lang) {
        App::setlocale($lang);
        return view('auth.loginAr');
    })->name('loginAr');
//    Route::get('/dashboard_ar', function () {
//        return view('_layouts.sidebarAr');
//    })->name('sidebarAr');

    #################### End Website AR ###################
    #################### Download Answers ###################
    Route::get('/download/answers', [EBuyerSurveyAnswerController::class, 'export'])->name('downloadAnswersExcel');

    Route::get('/download/supplier', [EBuyerSurveyAnswerController::class, 'supplier'])->name('downloadSupplierExcel');
    Route::get('/download/buyer', [EBuyerSurveyAnswerController::class, 'buyer'])->name('downloadBuyerExcel');
    Route::get('/downloads', function () {
        return view('website.downloads');
    })->name('downloads');
    #################### END ###############################
});

#################### Category ##########################
Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Route::post('languageChange', [DashboardController::class, 'languageChange'])->name('languageChange');
    Route::get('languageChange/{lang}/{rtl_value}', [DashboardController::class, 'languageChange'])->name('languageChange');
    Route::get('languageChangeForPayment/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForPayment'])->name('languageChangeForPayment');
    Route::get('languageChangeForPackagePayment/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForPackagePayment'])->name('languageChangeForPackagePayment');
    Route::get('languageChangeForIREEdit/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForIREEdit'])->name('languageChangeForIREEdit');
    Route::get('languageChangeForCommissionPercentage/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForCommissionPercentage'])->name('languageChangeForCommissionPercentage');
    Route::get('languageChangeForDownloadableFiles/{lang}/{rtl_value}', [DashboardController::class, 'languageChangeForDownloadableFiles'])->name('languageChangeForDownloadableFiles');
    Route::resource('users', UserController::class);
    Route::post('/registrationType', [UserController::class, 'registrationType']);

    // Adding National Id Card photo
    Route::post('national-id-card-image/{user_id}', [UserController::class, 'nationalIdCardPhoto'])->name('nationalIdCardPhoto');

    Route::middleware(['packageCheck', 'categoryCheck'])->group(function () {
        Route::resource('/business', BusinessController::class);
    });

    // Update business certificate route for Users
    Route::get('/update-certificates/', [BusinessController::class, 'certificateView'])->name('certificateView');
    Route::post('/update-certificates/', [BusinessController::class, 'certificateUpdate']);

    Route::middleware(['EmdadUsers'])->group(function (){
        // Update business certificate route for Emdad users
        Route::get('/certificates-update-requests/', [BusinessController::class, 'certificates'])->name('certificates');
        Route::get('/certificates-show/{id}', [BusinessController::class, 'certificateShow'])->name('certificateShow');
        Route::get('/certificates-status-update/{id}/{status}', [BusinessController::class, 'certificateStatusUpdate'])->name('certificateStatusUpdate');
        Route::middleware('ITAdmin')->get('/business-certificates-update/{id}', [BusinessController::class, 'certificateBusinessStatusUpdate'])->name('certificateBusinessStatusUpdate');

        Route::get('/incomplete-business-registration/', [BusinessController::class, 'incomplete'])->name('incompleteBusiness');
        Route::get('/business-status/', [BusinessController::class, 'accountStatus'])->name('accountStatus');
        Route::get('/business-legal-finance-status/', [BusinessController::class, 'businessLegalFinanceStatus'])->name('businessLegalFinanceStatus');
    });

    Route::resource('/businessFinanceDetail', BusinessFinanceDetailController::class);
    Route::get('/businessWarehouse/number-update', [BusinessWarehouseController::class, 'updateNumber'])->name('warehouseNumberUpdate');
    Route::resource('/businessWarehouse', BusinessWarehouseController::class);
    Route::get('/businessWarehouse', [BusinessWarehouseController::class, 'businessWarehouseShow'])->name('businessWarehouseShow');
    Route::get('/purchaseOrderInfo/store', [POInfoController::class, 'storeWithOutPOInfo'])->name('storeWithOutPOInfo');
    Route::resource('/purchaseOrderInfo', POInfoController::class);

    Route::get('category/show', [CategoryController::class, 'showAllCategories'])->name('showAllCategory');
    Route::get('businesses-related-to-category/{category_id}', [CategoryController::class, 'categoryRelatedBusiness'])->name('categoryRelatedBusiness');
    Route::get('active-rfq/{rfq_id}', [CategoryController::class, 'activeRFQs'])->name('activeRFQs');
    Route::get('active-rfq-details/{rfq_id}', [CategoryController::class, 'activeRFQView'])->name('activeRFQView');
    Route::resource('category', CategoryController::class);
    ####################END###############################

    #################### Super Admin Routes ###########################
    Route::middleware(['superAdmin'])->group(function (){
        Route::get('/logviewer', function () {
            return redirect('admin/logviewer');
        })->name('log.viewer');
        // User Log route for SuperAdmin
        Route::get('/user-logs', [UserController::class, 'user_log'])->name('user_logs');

        ##################### Download Controller ###################
        Route::get('/downloadable-files', [AdminDownloadController::class, 'index'])->name('adminDownload');
        Route::get('/create-downloadable-file', [AdminDownloadController::class, 'create'])->name('adminDownloadCreate');
        Route::post('/store-downloadable-file', [AdminDownloadController::class, 'store'])->name('adminDownloadStore');
        Route::post('/edit-downloadable-file', [AdminDownloadController::class, 'edit'])->name('adminDownloadEdit');
        Route::post('/update-downloadable-file', [AdminDownloadController::class, 'update'])->name('adminDownloadUpdate');
        Route::get('/delete-downloadable-file/{id}', [AdminDownloadController::class, 'delete'])->name('adminDownloadDelete');
        ############################# END ###########################

        ####################Admin IREs Controller###################
        Route::get('/ires', [AdminIreController::class, 'index'])->name('adminIres');
        Route::get('/ire-show', [AdminIreController::class, 'show'])->name('adminIreShow');
        Route::post('/ire-edit', [AdminIreController::class, 'edit'])->name('adminIreEdit');
        Route::post('/ire-update', [AdminIreController::class, 'update'])->name('adminIreUpdate');
        ####################END#####################################

        ##################### Commission Controller ##################
        Route::get('/commission-percentages', [CommissionPercentageController::class, 'index'])->name('adminPercentage');
        Route::get('/create-commission-percentage', [CommissionPercentageController::class, 'create'])->name('adminPercentageCreate');
        Route::post('/store-commission-percentage', [CommissionPercentageController::class, 'store'])->name('adminPercentageStore');
        Route::post('/edit-commission-percentage', [CommissionPercentageController::class, 'edit'])->name('adminPercentageEdit');
        Route::post('/update-commission-percentage', [CommissionPercentageController::class, 'update'])->name('adminPercentageUpdate');
        Route::get('/delete-commission-percentage/{id}', [CommissionPercentageController::class, 'delete'])->name('adminPercentageDelete');
        ############################### END ################################

        /* Super admin rating routes starts */
        Route::get('rating-view', [RatingController::class, 'view'])->name('ratingView');
        Route::get('ratings-list', [RatingController::class, 'index'])->name('ratingListIndex');
        Route::get('ratings-received/{id}', [RatingController::class, 'viewByID'])->name('ratingViewByID');
        Route::get('emdad-ratings', [RatingController::class, 'emdadRated'])->name('emdadRated');
        Route::get('emdad-rated/{id}', [RatingController::class, 'emdadRatedViewByID'])->name('emdadRatedViewByID');
        Route::get('emdad-not-rated', [RatingController::class, 'emdadUnRated'])->name('emdadUnRated');
        Route::get('rated-buyers', [RatingController::class, 'buyerRated'])->name('buyerRated');
        Route::get('rated-suppliers', [RatingController::class, 'supplierRated'])->name('supplierRated');
        Route::get('rate', [RatingController::class, 'buyerList'])->name('buyerList');
        Route::get('rate-buyer/{id}/{deliveryID}', [RatingController::class, 'createBuyerRating'])->name('rateBuyer');
        Route::post('save-buyer-rating', [RatingController::class, 'saveBuyerRating'])->name('storeBuyerRating');
        Route::get('rate-supplier', [RatingController::class, 'supplierList'])->name('supplierList');
        Route::get('rate-supplier/{id}/{deliveryID}', [RatingController::class, 'createSupplierRating'])->name('rateSupplier');
        Route::post('save-supplier-rating', [RatingController::class, 'saveSupplierRating'])->name('storeSupplierRating');
        /* Super admin rating routes ends */

        ###################### For Emdad Route start ##########################
        Route::get('emdad-supplier-manual-payment-show/{id}', [BankPaymentController::class, 'admin_supplier_payment_view'])->name('admin_supplier_payment_view');
        Route::post('update-supplier-manual-payment/{id}', [BankPaymentController::class, 'update_supplier_payment_status'])->name('update_supplier_payment_status');

        ####################### Single Category Quotation Payment routes ####################################
        Route::get('single-category-rfq-emdad-invoices-history', [PaymentController::class, 'singleCategoryPayments'])->name('singleCategoryPayments');
        Route::get('single-category-rfq-bank-payment/{id}', [BankPaymentController::class, 'singleCategoryShow'])->name('singleCategoryShow');
        Route::post('single-category-rfq-bank-payment-update/{rfq_no}', [BankPaymentController::class, 'singleCategoryUpdate'])->name('singleCategoryBankPaymentUpdate');
        Route::get('single-category-rfq-emdad-supplier-manual-payment/{rfq_no}', [BankPaymentController::class, 'singleCategoryAdminSupplierPaymentView'])->name('singleCategoryAdminSupplierPaymentView');
        Route::post('single-category-rfq-emdad-update-supplier-manual-payment/{rfqNo}', [BankPaymentController::class, 'singleCategoryUpdateSupplierPaymentStatus'])->name('singleCategoryUpdateSupplierPaymentStatus');
        Route::get('single-category-rfq-emdad-supplier-manual-payments', [PaymentController::class, 'singleCategorySupplierPayment'])->name('singleCategorySupplierPayment');

        #################### Roles display and update ##########################
        Route::resource('/role', RoleController::class);
        //Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'show'])->name('roles');
        #################### This is Permission Route ##########################
        Route::resource('/permission', PermissionController::class);

        ###################################### For Emdad Route start ###################################################
        Route::get('emdad-invoices-history', [PaymentController::class, 'payments'])->name('emdad_payments');
        Route::get('package-manual-payments', [PaymentController::class, 'packageManualPayments'])->name('packageManualPayments');
        Route::get('package-manual-payment-{id}', [PaymentController::class, 'packageManualPaymentView'])->name('packageManualPaymentView');
        Route::post('update-package-manual-payment-{id}', [PaymentController::class, 'updatePackageManualPayment'])->name('updatePackageManualPayment');
        Route::get('supplier-manual-payments', [PaymentController::class, 'supplier_payment'])->name('supplier_payment');
        ##################################### For Emdad Route end ######################################################
    });
    #################### Super Admin Routes END #######################

    #################### Buyer Routes Start ###########################
    Route::middleware(['buyer'])->group(function (){
        #################### RFQ Purchase Request Form ##########################
        Route::get('rfq-view', [PurchaseRequestFormController::class, 'view'])->name('rfqView');
        Route::get('rfq-cart-item-delete/{id}', [PurchaseRequestFormController::class, 'deleteCartItem'])->name('deleteCartItem');
        Route::resource('RFQ', PurchaseRequestFormController::class);

        // For Single Category RFQ
        Route::get('placed-single-category-rfq', [PlacedRFQController::class, 'single_category_rfq_index'])->name('single_category_rfq_index');
        Route::get('single-category-rfq/{id}', [PlacedRFQController::class, 'single_category_rfq_view'])->name('single_category_rfq_view');
        Route::get('create-single-category-rfq', [PurchaseRequestFormController::class, 'create_single_rfq'])->name('create_single_rfq');
        Route::post('create-single-category-rfq', [PurchaseRequestFormController::class, 'store_single_rfq']);
        Route::get('new-cart/{eOrderID}', [ECartController::class, 'deleteAndInsert'])->name('deleteAndInsertCart');
        Route::get('new-cart-single-category/{eOrderID}', [ECartController::class, 'singleDeleteAndInsert'])->name('deleteAndInsertCartSingleCategory');
        Route::get('edit-cart-item/{id}', [ECartController::class, 'edit'])->name('eCartItemEdit');
        Route::post('edit-cart-item/{id}', [ECartController::class, 'update']);
        Route::get('single-category-edit-cart-item/{id}', [ECartController::class, 'single_category_edit'])->name('singleCategoryECartItemEdit');
        Route::post('single-category-edit-cart-item/{id}', [ECartController::class, 'single_category_update']);
        Route::resource('RFQCart', ECartController::class);

        // For Single Category RFQ
        Route::get('single-category-cart', [ECartController::class, 'single_cart_index'])->name('single_cart_index');
        Route::post('store-single-category-cart-rfq', [ECartController::class, 'single_cart_store_rfq'])->name('single_cart_store_rfq');
        Route::post('delete-single-category-rfq/{id}', [ECartController::class, 'single_cart_destroy'])->name('single_cart_destroy');
        Route::resource('EOrders', EOrdersController::class);

        // For Single Category RFQ
        Route::post('store-single-category-rfq', [EOrdersController::class, 'single_category_store'])->name('single_category_store');
        Route::resource('PlacedRFQ', PlacedRFQController::class);

        Route::post('/change-company-check', [ECartController::class, 'companyCheck'])->name('companyCheck');

        Route::get('/RFQPlacedItems/{EOrderItems}', [PlacedRFQController::class, 'RFQItems'])->name('RFQItemsByID');
        Route::get('/RFQPlacedItems/pdf/{e_order_id}', [PlacedRFQController::class, 'PDF'])->name('RFQItemsPDF');

        ############################################### Quotation Routes Multiple Categories ###############################################
        Route::get('/QoutationsBuyerReceived', [QouteController::class, 'QoutationsBuyerReceived'])->name('QoutationsBuyerReceived');
        Route::post('/CancelRequisition', [EOrdersController::class, 'cancelRequisition'])->name('cancelRequisition');
        Route::get('/QoutationsBuyerReceived/{QouteItem}', [QouteController::class, 'QoutationsBuyerReceivedQouteID'])->name('QoutationsBuyerReceivedQouteID');
        Route::get('/QoutationsBuyerReceived/RFQItems/{EOrderItems}', [QouteController::class, 'QoutationsBuyerReceivedRFQItemsByID'])->name('QoutationsBuyerReceivedRFQItemsByID');
        Route::get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/qoutes/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedQoutes'])->name('QoutationsBuyerReceivedQoutes');
        Route::get('/QuotationResetTime/{EOrderItemID}/', [QouteController::class, 'resetQuotationTime'])->name('resetQuotationTime');
        Route::get('/QuotationDiscard/{EOrderItemID}/', [QouteController::class, 'discardQuotation'])->name('discardQuotation');
        Route::get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/rejected/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedRejected'])->name('QoutationsBuyerReceivedRejected');
        Route::get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/modification/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedModificationNeeded'])->name('QoutationsBuyerReceivedModificationNeeded');
        Route::get('/QoutationsBuyerReceived/RFQItems/{EOrderID}/accepted/{EOrderItemID}/{bypass_id}', [QouteController::class, 'QoutationsBuyerReceivedAccepted'])->name('QoutationsBuyerReceivedAccepted');
        Route::get('/Quotation/expired/status/{quoteID}', [QouteController::class, 'quotationExpiredStatusUpdate'])->name('QuotationExpiredStatusUpdate');
        Route::get('/single/category/quotation/expired/status/{quoteEOrderID}/{supplierBusinessID}', [QouteController::class, 'quotationExpiredStatusUpdateSingleCategory'])->name('quotationExpiredStatusUpdateSingleCategory');

        ################################## Single Category Quotations routes For Buyer ############################################
        Route::get('/single/category/rfq', [QouteController::class, 'singleCategoryBuyerRFQs'])->name('singleCategoryBuyerRFQs');
        Route::get('/single/category/rfq/items/{rfq_id}', [QouteController::class, 'singleCategoryRFQItems'])->name('singleCategoryRFQItems');
        Route::get('/single/category/rfq/item/response/{quote}', [QouteController::class, 'singleCategoryRFQItemByID'])->name('singleCategoryRFQItemByID');
        Route::get('/single/category/RFQ/quotations/{eOrderID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsBuyerReceived'])->name('singleCategoryRFQQuotationsBuyerReceived');
        Route::get('/singleCategoryQuotationResetTime/{eOrderID}/', [QouteController::class, 'resetSingleCategoryQuotationTime'])->name('resetSingleCategoryQuotationTime');
        Route::get('/singleCategoryQuotationDiscard/{eOrderID}/', [QouteController::class, 'discardSingleCategoryQuotation'])->name('discardSingleCategoryQuotation');
        Route::get('/single/category/RFQ/rejected/quotations/{EOrderItemID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsBuyerRejected'])->name('singleCategoryRFQQuotationsBuyerRejected');
        Route::get('/single/category/RFQ/modification/quotations/{eOrderID}/{bypass_id}', [QouteController::class, 'singleCategoryRFQQuotationsModificationNeeded'])->name('singleCategoryRFQQuotationsModificationNeeded');
        Route::post('single-rfq-quote/{quotes}/ModificationNeeded', [QouteController::class, 'singleCategoryRFQUpdateStatusModificationNeeded'])->name('singleCategoryRFQUpdateStatusModificationNeeded');
        Route::get('single-rfq-quote/{quotes}/Rejected', [QouteController::class, 'singleCategoryRFQUpdateStatusRejected'])->name('singleCategoryRFQUpdateStatusRejected');
        Route::post('singleCategoryQuote/Accepted', [QouteController::class, 'singleCategoryQuoteAccepted'])->name('singleCategoryQuoteAccepted');

        Route::post('qoute/{qoute}/ModificationNeeded', [QouteController::class, 'updateModificationNeeded'])->name('updateQoute');
        Route::get('qoute/{qoute}/Rejected', [QouteController::class, 'updateRejected'])->name('updateRejected');
        Route::post('qoute/{qoute}/Accepted', [QouteController::class, 'qouteAccepted'])->name('qouteAccepted');
        Route::get('dpo/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'show'])->name('dpo.show');
        Route::get('dpo', [DraftPurchaseOrderController::class, 'index'])->name('dpo.index');
        Route::get('/Quotation/expired/status/DPO/{quoteID}', [DraftPurchaseOrderController::class, 'quotationExpiredStatusUpdate'])->name('DPOExpiredStatusUpdate');
        Route::get('/Quotation/expired/status/reject/DPO/{quoteID}', [DraftPurchaseOrderController::class, 'quotationExpiredReject'])->name('DPOExpiredStatusReject');
        Route::get('/single/category/DPO/quotation/expired/status/{quoteEOrderID}', [DraftPurchaseOrderController::class, 'quotationExpiredStatusUpdateSingleCategory'])->name('DPOExpiredStatusUpdateSingleCategory');
        ##################################### Single Category DPO #######################################################
        Route::get('single/category/dpo', [DraftPurchaseOrderController::class, 'singleCategoryDPOIndex'])->name('singleCategoryDPOIndex');
        Route::post('single-category-dpo/file-upload', [DraftPurchaseOrderController::class, 'uploadSingleCategoryDPOFile'])->name('uploadSingleCategoryDPOFile');
        Route::get('single/category/dpo-{eOrderID}', [DraftPurchaseOrderController::class, 'singleCategoryDPOShow'])->name('singleCategoryDPOShow');
        Route::post('single/category/dpo/approved/{rfqNo}/{supplierBusinessID}', [DraftPurchaseOrderController::class, 'singleCategoryApproved'])->name('singleCategoryApproved');
        Route::post('single/category/dpo/cancel/{rfqNo}/{supplierBusinessID}', [DraftPurchaseOrderController::class, 'singleCategoryCancel'])->name('singleCategoryCancel');
        #################################################################################################################
        Route::post('dpo/file-upload', [DraftPurchaseOrderController::class, 'uploadDPOFile'])->name('uploadDPOFile');
        Route::post('dpo/{draftPurchaseOrder}/approved', [DraftPurchaseOrderController::class, 'approved'])->name('dpo.approved');
        Route::post('cash/dpo/{draftPurchaseOrder}/approved', [DraftPurchaseOrderController::class, 'approved'])->name('cashDpo.approved');
        Route::get('dpo/{draftPurchaseOrder}/rejected', [DraftPurchaseOrderController::class, 'rejected'])->name('dpo.rejected');
        Route::get('dpo/{draftPurchaseOrder}/cancel', [DraftPurchaseOrderController::class, 'cancel'])->name('dpo.cancel');

        /* Buyer rating routes starts */
        Route::get('rating', [RatingController::class, 'buyerRatingView'])->name('buyerRatingView');
        Route::get('deliveries-ratings', [RatingController::class, 'buyerDeliveryIndex'])->name('buyerDeliveryRatingListIndex');
        Route::get('delivery-ratings/{id}', [RatingController::class, 'buyerDeliveryViewByID'])->name('buyerDeliveryRatingViewByID');
        Route::get('buyer-rated', [RatingController::class, 'buyerRatedToDeliveries'])->name('buyerRatedToDeliveries');
        Route::get('buyer-rated/{id}', [RatingController::class, 'buyerRatedViewByID'])->name('buyerRatedViewByID');
        Route::get('buyer-not-rated', [RatingController::class, 'buyerUnRatedDeliveries'])->name('buyerUnRatedDeliveries');
        Route::get('rate-deliveries', [RatingController::class, 'deliveriesListToRate'])->name('deliveriesListToRate');
        Route::get('rate-delivery/{supplierID}/{driverID}/{deliveryID}', [RatingController::class, 'createDeliveryRating'])->name('rateDelivery');
        Route::post('save-buyer-rated', [RatingController::class, 'saveBuyerRatedToDelivery'])->name('storeBuyerRatedToDelivery');
        /* Buyer rating routes ends */

        ####################### Single Category Quotation Payment routes ####################################
        Route::get('single-category-rfq-proforma-invoices', [PaymentController::class, 'singleCategoryProformaInvoices'])->name('singleCategoryProformaInvoices');
        Route::post('single-category-rfq-bank-payments/update/bank-payment/{rfq_no}', [BankPaymentController::class, 'singleUpdatePayment'])->name('singleCategoryBankPaymentBuyerUpdate');
        #####################################################################################################

        Route::get('proforma-invoices', [PaymentController::class, 'proforma_invoices'])->name('proforma_invoices');

        ###################################################### Buyer adding Supplier ##########################################
        Route::get('add-supplier', [UserController::class, 'createSupplier'])->name('createSupplier');
        Route::post('store-supplier', [UserController::class, 'storeSupplier'])->name('storeSupplier');
        Route::get('/business-suppliers/', [BusinessController::class, 'suppliers'])->name('businessSuppliers');
    });
    #################### Buyer Routes END #############################

    #################### Supplier Routes Start ########################
    Route::middleware(['supplier'])->group(function (){
        Route::get('/viewRFQs', [PlacedRFQController::class, 'viewRFQs'])->name('viewRFQs');
        Route::get('/viewRFQs/{eOrderItems}', [PlacedRFQController::class, 'viewRFQsID'])->name('viewRFQsID');
        Route::get('/single-category-RFQs', [PlacedRFQController::class, 'viewSingleCategoryRFQs'])->name('singleCategoryRFQs');
        Route::get('/quote-RFQs-for-single-category-{eOrder}', [PlacedRFQController::class, 'viewSingleCategoryRFQByID'])->name('viewSingleCategoryRFQByID');
        Route::get('/modification-needed-quote-RFQs-for-single-category-{quote}', [PlacedRFQController::class, 'viewModifiedSingleCategoryRFQByID'])->name('viewModifiedSingleCategoryRFQByID');

        Route::get('/QoutedRFQ/Qouted', [QouteController::class, 'QoutedRFQQouted'])->name('QoutedRFQQouted');
        Route::get('/Quoted/Modified/RFQs', [QouteController::class, 'QuotedModifiedRFQ'])->name('QuotedModifiedRFQ');
        Route::get('/QoutedRFQ/Rejected', [QouteController::class, 'QoutedRFQRejected'])->name('QoutedRFQRejected');
        Route::get('/QoutedRFQ/ModificationNeeded', [QouteController::class, 'QoutedRFQModificationNeeded'])->name('QoutedRFQModificationNeeded');
        Route::get('/QoutedRFQ/PendingConfirmation', [QouteController::class, 'QoutedRFQQoutedRFQPendingConfirmation'])->name('QoutedRFQPendingConfirmation');
        Route::get('/QoutedRFQ/Expired', [QouteController::class, 'QoutedRFQQoutedExpired'])->name('QoutedRFQQoutedExpired');
        Route::get('/QoutedRFQQoutedView/{quoteID}', [QouteController::class, 'QoutedRFQQoutedViewByID'])->name('QoutedRFQQoutedViewByID');

        ########################################## Single Category RFQ routes For Supplier ############################################
        Route::get('/single/category/quoted-RFQs', [QouteController::class, 'singleCategoryQuotedRFQQuoted'])->name('singleCategoryQuotedRFQQuoted');
        Route::get('/single/category/quoted/modified/RFQs', [QouteController::class, 'singleCategoryQuotedModifiedRFQ'])->name('singleCategoryQuotedModifiedRFQ');
        Route::get('/single/category/rejected-RFQs', [QouteController::class, 'singleCategoryQuotedRFQRejected'])->name('singleCategoryQuotedRFQRejected');
        Route::get('/single/category/modification/needed/RFQs', [QouteController::class, 'singleCategoryQuotedRFQModificationNeeded'])->name('singleCategoryQuotedRFQModificationNeeded');
        Route::get('/single/category/pending/confirmation/RFQs', [QouteController::class, 'singleCategoryQuotedRFQPendingConfirmation'])->name('singleCategoryQuotedRFQPendingConfirmation');
        Route::get('/single/category/expired/RFQs', [QouteController::class, 'singleCategoryRFQExpired'])->name('singleCategoryRFQExpired');
        Route::get('/single/category/quoted/view/{eOrderID}', [QouteController::class, 'singleCategoryRFQQuotedViewByID'])->name('singleCategoryRFQQuotedViewByID');

        ############################################ Quotation Routes Multiple Categories ##############################################################
        Route::post('/Quotation/expired/response/', [QouteController::class, 'quotationExpiredStatusResponse'])->name('QuotationExpiredStatusResponse');
        Route::get('/Quotation/expired/reject/response/{quoteID}', [QouteController::class, 'quotationExpiredStatusRejectResponse'])->name('quotationExpiredStatusRejectResponse');
        Route::post('/single/category/quotation/expired/response/', [QouteController::class, 'quotationExpiredStatusResponseSingleCategory'])->name('quotationExpiredStatusResponseSingleCategory');
        Route::get('/single/category/quotation/expired/reject/response/{quoteEOrderID}', [QouteController::class, 'quotationExpiredStatusRejectResponseSingleCategory'])->name('quotationExpiredStatusRejectResponseSingleCategory');

        Route::get('deliveries', [DeliveryNoteController::class, 'view'])->name('deliveryView');
        Route::get('/deliveryNote/{draftPurchaseOrder}/view', [DeliveryNoteController::class, 'deliveryNoteView'])->name('deliveryNoteView');
        Route::resource('deliveryNote', DeliveryNoteController::class);
        Route::get('/single/category/delivery/notes', [DeliveryNoteController::class, 'singleCategoryIndex'])->name('singleCategoryIndex');
        Route::get('/single/category/deliveryNote/{rfqNo}/view', [DeliveryNoteController::class, 'singleCategoryDeliveryNoteView'])->name('singleCategoryDeliveryNoteView');
        Route::post('/single/category/deliveryNote/{rfqNo}/save', [DeliveryNoteController::class, 'singleCategoryStore'])->name('singleCategoryDeliveryNoteStore');
        Route::get('/notes', [DeliveryNoteController::class, 'notes'])->name('notes');
        Route::get('/notes/{deliveryNote}', [DeliveryNoteController::class, 'viewNote'])->name('viewNote');
        Route::get('/single/category/notes', [DeliveryNoteController::class, 'singleCategoryNotes'])->name('singleCategoryNotes');
        Route::get('/single/category/notes/{rfq_no}', [DeliveryNoteController::class, 'singleCategoryViewNote'])->name('singleCategoryViewNote');

        ###################### Vehicle routes ####################################
        Route::resource('vehicle', VehicleController::class);
        #################### END ##################################################

        ##################### Shipment routes ####################################
        Route::resource('shipmentCart', ShipmentCartController::class);
        Route::resource('shipmentItem', ShipmentItemController::class);
        #################### END ##################################################

        /* Supplier rating routes starts */
        Route::get('ratings', [RatingController::class, 'supplierRatingView'])->name('supplierRatingView');
        Route::get('deliveries-rating', [RatingController::class, 'supplierDeliveryIndex'])->name('supplierDeliveryRatingListIndex');
        Route::get('delivery/ratings/{id}', [RatingController::class, 'supplierDeliveryViewByID'])->name('supplierDeliveryRatingViewByID');
        Route::get('supplier-rated', [RatingController::class, 'supplierRatedToDeliveries'])->name('supplierRatedToDeliveries');
        Route::get('supplier-rated/{id}', [RatingController::class, 'supplierRatedViewByID'])->name('supplierRatedViewByID');
        Route::get('supplier-not-rated', [RatingController::class, 'supplierUnRatedDeliveries'])->name('supplierUnRatedDeliveries');
        Route::get('deliveries-to-rate', [RatingController::class, 'supplierDeliveriesListToRate'])->name('supplierDeliveriesListToRate');
        Route::get('rate-delivery-by-supplier/{buyerID}/{deliveryID}', [RatingController::class, 'createDeliveryRatingBySupplier'])->name('rateDeliveryBySupplier');
        Route::post('save-supplier-rated', [RatingController::class, 'saveSupplierRatedToDelivery'])->name('storeSupplierRatedToDelivery');
        /* Supplier rating routes ends */

        Route::post('single-quote-store', [QouteController::class, 'singleRFQQuotationStore'])->name('singleRFQQuotationStore');
        Route::post('single-quote-update', [QouteController::class, 'singleRFQQuotationUpdate'])->name('singleRFQQuotationUpdate');
        /* Calculating totalCost at the time of Supplier RFQ response */
        Route::get('total-cost', [QouteController::class, 'totalCost'])->name('totalCost');
        /* Calculating totalCost for single category RFQ Type at the time of Supplier RFQ response */
        Route::get('single-total-cost', [QouteController::class, 'singleTotalCost'])->name('singleTotalCost');

        ########################################################## Payment routes #################################################################################
        Route::get('payments', [PaymentController::class, 'view'])->name('paymentView');
        Route::resource('payment', PaymentController::class);
        Route::get('generate-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoiceView'])->name('generateProformaView');
        Route::get('create-proforma-invoice/{id}', [PaymentController::class, 'generateProformaInvoice'])->name('generateProforma');
        Route::get('manual-payments', [PaymentController::class, 'supplier_payment_received'])->name('supplier_payment_received');
        Route::get('supplier-manual-payment-show/{id}', [BankPaymentController::class, 'supplier_payment_view'])->name('supplier_payment_view');
        Route::post('supplier-manual-payment-update/{id}', [BankPaymentController::class, 'update_bank_payment'])->name('update_bank_payment');

        ####################### Single Category Quotation Payment routes ####################################
        Route::get('single-category-rfq-manual-payments', [PaymentController::class, 'singleCategorySupplierPaymentsReceived'])->name('singleCategorySupplierPaymentsReceived');
        Route::get('single-category-rfq-supplier-manual-payment/{id}', [BankPaymentController::class, 'singleCategorySupplierPaymentView'])->name('singleCategorySupplierPaymentView');
        Route::post('single-category-rfq-supplier-manual-payment-update/{rfqNo}', [BankPaymentController::class, 'singleCategoryUpdateBankPayment'])->name('singleCategoryUpdateBankPayment');
        #####################################################################################################

        Route::get('generate-proforma-invoice', [PaymentController::class, 'generate_proforma_invoice'])->name('generate_proforma_invoices');

        ###################################################### Supplier adding buyer ##########################################
        Route::get('add-buyer', [UserController::class, 'createBuyer'])->name('createBuyer');
        Route::post('store-buyer', [UserController::class, 'storeBuyer'])->name('storeBuyer');
        Route::get('/business-buyers/', [BusinessController::class, 'buyers'])->name('businessBuyers');
    });
    #################### Supplier Routes END ##########################

    // For Single category RFQ
    Route::get('/rfq-with-no-quotations', [PlacedRFQController::class, 'RFQsWithNoQuotations'])->name('RFQsWithNoQuotations');
    Route::get('/rejectRFQ/{eOrderID}', [PlacedRFQController::class, 'rejectRFQ'])->name('rejectRFQ');
    Route::get('/RFQsQouted', [PlacedRFQController::class, 'RFQsQouted'])->name('RFQsQouted');
    //Route::get('/view-RFQs-for-single-category-{eOrderID}', [PlacedRFQController::class, 'viewRFQsOfSingleCategory'])->name('viewRFQsOfSingleCategory');
    //Route::get('/quote-RFQs-for-single-category-{eOrderItems}', [PlacedRFQController::class, 'viewSingleCategoryRFQByID'])->name('viewSingleCategoryRFQByID');

    /* Generating PDF file for Multi Category Quotation Supplier quoted. */
    Route::get('/generate-pdf/{eOrderItemID}', [PlacedRFQController::class, 'quotedQuotationPDF'])->name('PDFForQuotation');

    Route::resource('qoute', QouteController::class);

    /* Generating PDF file for Single Category Quotation Supplier quoted */
    Route::get('/generate-single-category-quotation-pdf/{quoteID}/{eOrderItemID}', [PlacedRFQController::class, 'singleCategoryQuotedQuotationPDF'])->name('PDFForSingleCategoryQuotation');
    #############################################################################################################

    /* Generating PDF file for Multi Category Quotation buyer received */
    Route::get('generate-quotation-pdf/{quote_supplier_business_id}/{e_order_id}', [QouteController::class, 'quotationPDF'])->name('quotationPDF');

    /* Generating PDF file for Single Category Quotation buyer received */
    Route::get('single-rfq-quotation-pdf/{quote_supplier_business_id}/{e_order_id}', [QouteController::class, 'singleCategoryQuotationPDF'])->name('singleCategoryQuotationPDF');
    #################################################################################################################

    Route::resource('QuotationMessage', QouteMessageController::class);

    #################### PDF generate Routes ##########################
    Route::get('/generate-PO-pdf/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'generatePDF'])->name('generatePDF');
    Route::post('/single/category/generate/PO/pdf/{rfqNO}', [DraftPurchaseOrderController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryGeneratePDF');
    #################### END ##########################################

    #################################################### Delivery and Delivery Note ###################################################

    Route::get('delivery-details/{rfq_no}/{deliveryID}/{rfq_type}', [DeliveryController::class, 'show'])->name('deliveryDetails');
    Route::get('delivery-note-pdf/{deliveryID}/{rfq_no}/{rfq_type}/', [DeliveryController::class, 'pdf'])->name('deliveryNotePDF');
    Route::get('/generate-delivery-note-pdf/{deliveryNote}', [DeliveryNoteController::class, 'generatePDF'])->name('generateDeliveryNotePDF');

    ##################### Single Category RFQ Delivery and Delivery Note routes ####################################
    Route::get('/generate-single-category-delivery-note-pdf/{deliveryNoteRfqNo}', [DeliveryNoteController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryDeliveryNoteGeneratePDF');
    ################################### END ########################################################################

    ######################################## Purchase order routes #################################################
    Route::get('/po', [DraftPurchaseOrderController::class, 'po'])->name('po.po');
    Route::get('/po/{draftPurchaseOrder}', [DraftPurchaseOrderController::class, 'poShow'])->name('po.show');

    ######################################## Single Category RFQ PO routes #########################################
    Route::get('/single/category/po', [DraftPurchaseOrderController::class, 'singleCategoryPO'])->name('singleCategoryPO');
    Route::get('/single/category/po/{rfqNo}', [DraftPurchaseOrderController::class, 'singleCategoryPOShow'])->name('singleCategoryPOByID');
    ##################################################### END ######################################################

    ######################################### Shipment routes ######################################################
    Route::resource('shipment', ShipmentController::class);
    Route::get('delivered-shipments', [ShipmentController::class, 'delivered'])->name('deliveredShipments');
    Route::get('ongoing-shipments', [ShipmentController::class, 'ongoingShipment'])->name('ongoingShipment');
    ############################################### END ############################################################

    ###################################### Generate Invoice & Delivery #############################################
    Route::post('/invoice/generate', [InvoiceController::class, 'invoiceGenerate'])->name('invoice.generate');
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/emdad-invoices/', [EmdadInvoiceController::class, 'index'])->name('emdadInvoices');
    Route::get('/emdad-invoice/{id}', [EmdadInvoiceController::class, 'view'])->name('emdadInvoiceView');
    Route::get('/generate-emdad-invoice/{id}', [EmdadInvoiceController::class, 'generateInvoice'])->name('emdadGenerateInvoice');
    Route::get('/generate-emdad-invoice-pdf/{emdadInvoiceID}', [EmdadInvoiceController::class, 'generatePDF'])->name('generateEmdadInvoicePDF');

    ########################################## Single Category Invoice & Delivery Routes ###########################
    Route::get('single/category/invoice/{invoiceID}', [InvoiceController::class, 'singleCategoryShow'])->name('singleCategoryInvoiceShow');
    Route::post('single/category/invoice/generate', [InvoiceController::class, 'singleCategoryInvoiceGenerate'])->name('singleCategoryInvoiceGenerate');
    Route::get('/single/category/emdad-invoices/', [EmdadInvoiceController::class, 'singleCategoryIndex'])->name('singleCategoryEmdadInvoicesIndex');
    Route::get('/single/category/emdad-invoice/{rfq_no}', [EmdadInvoiceController::class, 'singleCategoryView'])->name('singleCategoryView');
    Route::post('/single/category/generate-emdad-invoice', [EmdadInvoiceController::class, 'singleCategoryGenerateInvoice'])->name('singleCategoryGenerateInvoice');
    Route::get('/generate-single-category-emdad-invoice-pdf/{emdadInvoiceRFQNo}', [EmdadInvoiceController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryEmadadInvoiceGeneratePDF');
    #################################################### END #######################################################

    ############################################## Payment routes ##################################################
    Route::get('invoices-history', [PaymentController::class, 'invoices'])->name('invoices');

    Route::get('invoice-details/{id}', [PaymentController::class, 'invoiceView'])->name('invoiceView');
    Route::resource('bank-payments', BankPaymentController::class)->names('bank-payments');
    Route::get('bank-payments/{invoice}/create', [BankPaymentController::class, 'create'])->name('bank-payments.create');
    Route::get('bank-payments/{invoice}/edit', [BankPaymentController::class, 'edit'])->name('bank-payments.edit');
    Route::post('bank-payments/update', [BankPaymentController::class, 'update_payment'])->name('bank_payments_update');
    //Route::resource('moyasar-payment', Moyas::class)->names('mps');
    Route::get('/generate-invoice-pdf/{invoiceID}', [PaymentController::class, 'generatePDF'])->name('generateInvoicePDF');

    ####################### Single Category Quotation Payment routes ####################################
    Route::get('single-category-rfq-payment', [PaymentController::class, 'singleCategoryIndex'])->name('singleCategoryPaymentIndex');
    Route::get('single-category-rfq-proforma-invoice', [PaymentController::class, 'singleCategoryGenerateProformaInvoiceView'])->name('singleCategoryGenerateProformaInvoiceView');
    Route::get('single-category-rfq-generate-proforma-invoice/{rfqNo}', [PaymentController::class, 'singleCategoryGenerateProformaInvoice'])->name('singleCategoryGenerateProformaInvoice');
    Route::get('single-category-rfq-invoice-details/{rfq_no}', [PaymentController::class, 'singleCategoryInvoiceView'])->name('singleCategoryInvoiceView');
    Route::get('single-category-rfq-bank-payments/{rfq_no}/create', [BankPaymentController::class, 'singleCategoryCreate'])->name('singleCategoryBankPaymentCreate');
    Route::get('single-category-rfq-bank-payments/{id}/edit', [BankPaymentController::class, 'singleCategoryEdit'])->name('singleCategoryBankPaymentEdit');
    Route::post('single-category-rfq-bank-payment-store', [BankPaymentController::class, 'singleCategoryStore'])->name('singleCategoryStore');
    Route::get('single-category-rfq-invoices-history', [PaymentController::class, 'singleCategoryInvoices'])->name('singleCategoryInvoices');
    Route::get('single-category-rfq-unpaid-bank-payments', [BankPaymentController::class, 'singleCategoryIndex'])->name('singleCategoryBankPaymentIndex');
    Route::get('/generate-single-category-invoice-pdf/{invoiceRfqNo}', [PaymentController::class, 'singleCategoryGeneratePDF'])->name('singleCategoryInvoiceGeneratePDF');
    ################################################################### END ############################################################################################

    ########################################## Subscription routes ####################################
    // Route::get('sub', function () {
    //     return view('subscription.index');
    // })->name('subscription');
    ################################################# END ##############################################################

    //Route::post('/make-payment', [\App\Http\Controllers\MakePaymentController::class, 'makePayment'])->name('make.payment');
    //Route::get('/payment-status', [\App\Http\Controllers\MakePaymentController::class, 'paymentStatus'])->name('payment.status');
    //return view('moyasar_payment.payment');


    Route::post('/credit/step-one', [MakePaymentController::class, 'getPaymentCheckOutId'])->name('getPaymentCheckOutId');
    Route::post('/process-payment', [MakePaymentController::class, 'processPayment'])->name('processPaymentCheckout');
    Route::get('/process-payment-status', [MakePaymentController::class, 'processPaymentStatus'])->name('processPaymentStatus');


    Route::get('subscription-update/{id}', [PackageController::class, 'update'])->name('subscriptionUpdate');
    Route::get('subscription-pdf', [PackageController::class, 'pdf'])->name('subscriptionPDF');
    Route::get('payment-type/{id}', [PackageController::class, 'view'])->name('packagePaymentType');
    Route::get('payment-response/{id}', [PackageController::class, 'paymentView'])->name('paymentResponseView');
    Route::get('upgrade-package-manual-payment-{id}', [PackageController::class, 'manualPaymentUpgradingView'])->name('manualPaymentUpgradingView');
    Route::get('manual-payment-type/{id}', [PackageController::class, 'manualPaymentView'])->name('manualPackagePaymentView');
    Route::post('store-manual-payment', [PackageController::class, 'storeManualPayment'])->name('storeManualPayment');
    Route::post('update-manual-payment', [PackageController::class, 'updateManualPayment'])->name('updateManualPayment');
    Route::resource('packages', PackageController::class);
    Route::get('business-packages/status', [BusinessPackageController::class, 'businessPackagePaymentStatus'])->name('businessPackage.paymentStatus');
    Route::post('business-packages/step-one', [BusinessPackageController::class, 'getCheckOutId'])->name('businessPackage.stepOne');
    Route::resource('business-packages', BusinessPackageController::class);
    /* Route for upgrading package */
    Route::post('subscription-store/', [BusinessPackageController::class, 'storeBusinessPackageUpgrade'])->name('storeBusinessPackageUpgrade');
    Route::get('subscription-payment-status/', [BusinessPackageController::class, 'businessPackageUpgradePaymentStatus'])->name('businessPackageUpgradePaymentStatus');

    Route::post('business-packages/checkout', [BusinessPackageController::class, 'getCheckOutId'])->name('businessPackage.getCheckOutId');
    Route::post('updateCategories', [BusinessPackageController::class, 'updateCategories'])->name('updatePackageCategories');
    Route::post('business-package-store/{id}', [BusinessPackageController::class, 'store'])->name('business-package.store');
    ######################################################## END ##############################################################

    Route::get('select-category', [CategoryController::class, 'parentCategories'])->name('parentCategories');
    Route::get('sub-categories', [CategoryController::class, 'subCategories'])->name('subCategories');

    ############################################### SMS routes ########################################################
    Route::resource('smsMessages', SmsMessagesController::class)->middleware('permission:all');

    #invoice payment
    Route::post('invoice-payment/step-one', [BusinessPackageController::class, 'getCheckOutId_InvoicePayment'])->name('invoicePayment.stepOne');
    Route::post('invoice-payment/proceed_payment', [BusinessPackageController::class, 'proceed_payment'])->name('invoicePayment.proceed_payment');
    Route::get('invoice-payment/invoice_payment_status', [BusinessPackageController::class, 'invoice_payment_status'])->name('invoice_payment_status');

    ########################################################## END ####################################################
    //Route::middleware(['verified'])->group(function () {
    Route::group([],function () {
        Route::get('showLibrary', [LibraryController::class,'showLibrary'])->name('showLibrary');
        Route::get('markAsRead', [LibraryController::class,'markRead'])->name('markRead');
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
});

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

Route::get('/search', [IreLoginController::class, 'search_ire'])->name('search_ire');
Route::post('ireLanguageChange', [IreController::class, 'languageChange'])->name('ireLanguageChange');

Route::get('tree', function () {
    $parentCategories = Category::where('parent_id', 0)->where('is_active',1)->orderBy('name', 'asc')->get();
    return view('test.combotree',compact('parentCategories'));
});


// Route::get('/testSms', function () {
//     $pdf = App::make('snappy.pdf.wrapper');
//     $pdf->loadHTML('<h1>Test</h1>');
    // return $pdf->inline();
//    $x = User::send_otp('6633','581382822');
//    dd($x);
// });

//        User::find(5)->notify(new UserRegistration());


Route::get('/sendMail', function() {
    // info('reached');
    \Artisan::call('queue:work --queue=email  --stop-when-empty');
    // info('end reached');
//     dd('done');
});


