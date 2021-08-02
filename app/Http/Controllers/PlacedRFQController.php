<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessPackage;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Package;
use App\Models\PlacedRFQ;
use App\Models\Qoute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacedRFQController extends Controller
{
    public function index()
    {
        if (\auth()->user()->hasRole('SuperAdmin'))
        {
//            $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->get();
            $PlacedRFQ = EOrders::all();
        }
        else{
//            $PlacedRFQ = EOrders::where('business_id', auth()->user()->business_id)->get();
            $PlacedRFQ = EOrders::with('userName')->where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->get();
        }

        return view('RFQPlaced.index', compact('PlacedRFQ'));
    }

    public function RFQItems(Request $request, $EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->get();
        return view('RFQPlaced.show', compact('collection'));
    }

    public function viewRFQs()
    {

        if (\auth()->user()->hasRole('SuperAdmin'))
        {
            $business_categories = [];
            $business_cate = BusinessCategory::all();
            if ($business_cate->isNotEmpty()) {
                foreach ($business_cate as $item) {
                    $business_categories[] = (int)$item->category_number;
                }
            }
            sort($business_categories);
            // $business_categories = implode(",", $business_categories);
            $collection = EOrderItems::where('status', 'pending')->whereIn('item_code', $business_categories)->get();

            $quotationCount = null;
            return view('supplier.index', compact('collection','quotationCount'));
        }
        else
            {
                $user_business_id = Auth::user()->business_id;
                $business_categories = [];
                $business_cate = BusinessCategory::where('business_id', $user_business_id)->get();
                if ($business_cate->isNotEmpty()) {
                    foreach ($business_cate as $item) {
                        $business_categories[] = (int)$item->category_number;
                    }
                }

                sort($business_categories);
                // $business_categories = implode(",", $business_categories);
//                $collection = EOrderItems::where('status', 'pending')->where('bypass', 0)->whereDate('quotation_time', '>=', Carbon::now())->whereIn('item_code', $business_categories)->get();
                $collection = EOrderItems::where(['status' => 'pending', 'rfq_type' => 1])->where('bypass', 0)->whereDate('quotation_time', '>=', Carbon::now())->whereIn('item_code', $business_categories)->get();

                // Remaining Quotations count
                $quotations = Qoute::where('supplier_business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
                $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
                $package = Package::where('id', $business_package->package_id)->first();
                if ($business_package->package_id == 5 || $business_package->package_id == 6)
                {
                    $quotationCount = $package->quotations - $quotations;
                }
                else{
                    $quotationCount = null;
                }

                return view('supplier.index', compact('collection','quotationCount'));
            }
    }

    public function viewRFQsID(EOrderItems $eOrderItems)
    {
        $user_id = auth()->user()->id;
        $user_business_id = auth()->user()->business_id;
        $collection = Qoute::where('e_order_items_id', $eOrderItems->id)->where('supplier_user_id', $user_id)->first();
        return view('supplier.supplier-quote', compact('eOrderItems', 'collection', 'user_business_id'));
    }

    public function RFQsQouted($EOrderItems)
    {
        $collection = EOrderItems::where('e_orders_id', $EOrderItems)->get();
        return view('RFQPlaced.show', compact('collection'));
    }

    public function RFQsWithNoQuotations()
    {
        $rfqs = \App\Models\EOrderItems::with('qoutes')->doesntHave('qoutes')->get();
        return view('RFQ.noQuotationReceived', compact('rfqs'));
    }

    ######################## Functions for Single Category RFQ (FOR BUYER) ############################

    public function single_category_rfq_index()
    {
        $PlacedRFQ = EOrders::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->get();

        return view('RFQPlaced.singleCategory.index', compact('PlacedRFQ'));
    }

    public function single_category_rfq_view($EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->get();

        return view('RFQPlaced.singleCategory.view', compact('collection'));
    }

    ###################################################################################################

    ########################  Functions for Single Category RFQ (FOR SUPPLIER) ##########################

    /* Getting all RFQs by e_order */
    public function viewSingleCategoryRFQs()
    {
        if (\auth()->user()->hasRole('SuperAdmin'))
        {
            $business_categories = [];
            $business_cate = BusinessCategory::all();
            if ($business_cate->isNotEmpty()) {
                foreach ($business_cate as $item) {
                    $business_categories[] = (int)$item->category_number;
                }
            }
            sort($business_categories);
            // $business_categories = implode(",", $business_categories);
            $collection = EOrderItems::where('status', 'pending')->whereIn('item_code', $business_categories)->get();

            $quotationCount = null;
            return view('supplier.index', compact('collection','quotationCount'));
        }
        else
        {
            $user_business_id = Auth::user()->business_id;
            $business_categories = [];
            $business_cate = BusinessCategory::where('business_id', $user_business_id)->get();
            if ($business_cate->isNotEmpty()) {
                foreach ($business_cate as $item) {
                    $business_categories[] = (int)$item->category_number;
                }
            }
            sort($business_categories);

            $eOrders = EOrders::where(['rfq_type' => 0])->get();

            // Remaining Quotations count
            $quotations = Qoute::where('supplier_business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
            $business_package = BusinessPackage::where(['business_id' => auth()->user()->business_id, 'status' => 1])->first();
            $package = Package::where('id', $business_package->package_id)->first();
            if ($business_package->package_id == 5 || $business_package->package_id == 6)
            {
                $quotationCount = $package->quotations - $quotations;
            }
            else{
                $quotationCount = null;
            }

            return view('supplier.singleCategoryRFQ.index', compact('eOrders','quotationCount', 'business_categories'));
        }
    }

    /* Getting all RFQs by e_order_items against e_order */
//    public function viewRFQsOfSingleCategory($eOrderID)
//    {
//
//        if (\auth()->user()->hasRole('SuperAdmin'))
//        {
//            $business_categories = [];
//            $business_cate = BusinessCategory::all();
//            if ($business_cate->isNotEmpty()) {
//                foreach ($business_cate as $item) {
//                    $business_categories[] = (int)$item->category_number;
//                }
//            }
//            sort($business_categories);
//            // $business_categories = implode(",", $business_categories);
//            $collection = EOrderItems::where('status', 'pending')->whereIn('item_code', $business_categories)->get();
//
//            $quotationCount = null;
//            return view('supplier.index', compact('collection','quotationCount'));
//        }
//        else
//        {
//            $user_business_id = Auth::user()->business_id;
//            $business_categories = [];
//            $business_cate = BusinessCategory::where('business_id', $user_business_id)->get();
//            if ($business_cate->isNotEmpty()) {
//                foreach ($business_cate as $item) {
//                    $business_categories[] = (int)$item->category_number;
//                }
//            }
//            sort($business_categories);
//
//            $collection = EOrderItems::where(['status' => 'pending', 'e_order_id' => $eOrderID])->where('bypass', 0)->whereDate('quotation_time', '>=', Carbon::now())->whereIn('item_code', $business_categories)->get();
//
//            // Remaining Quotations count
//            $quotations = Qoute::where('supplier_business_id', auth()->user()->business_id)->whereDate('created_at', \Carbon\Carbon::today())->count();
//            $business_package = BusinessPackage::where('business_id', auth()->user()->business_id)->first();
//            $package = Package::where('id', $business_package->package_id)->first();
//            if ($business_package->package_id == 5 || $business_package->package_id == 6)
//            {
//                $quotationCount = $package->quotations - $quotations;
//            }
//            else{
//                $quotationCount = null;
//            }
//
//            return view('supplier.singleCategoryRFQ.view', compact('collection','quotationCount'));
//        }
//    }

    /* Getting Quotation by e_order_item ID */
    /* Getting Quotation by e_order ID */
//    public function viewSingleCategoryRFQByID(EOrderItems $eOrderItems)
    public function viewSingleCategoryRFQByID(EOrders $eOrder)
    {
        $user_business_id = auth()->user()->business_id;
//        $collection = Qoute::where('e_order_items_id', $eOrderItems->id)->where('supplier_user_id', $user_id)->first();
        $eOrderItems = EOrderItems::where('e_order_id', $eOrder->id)->get();
        $collection = Qoute::where('e_order_id', $eOrder->id)->where('supplier_business_id', \auth()->user()->business_id)->first();

//        return view('supplier.singleCategoryRFQ.viewById', compact('eOrderItems', 'collection', 'user_business_id'));
        return view('supplier.singleCategoryRFQ.viewById', compact('eOrder', 'eOrderItems','collection', 'user_business_id'));
    }

    /* Same function as viewSingleCategoryRFQByID function but this is for modification we are passing Quote in this whereas in viewSingleCategoryRFQByID we are passing EOrder */
    public function viewModifiedSingleCategoryRFQByID(Qoute $quote)
    {
        $user_business_id = auth()->user()->business_id;
        $eOrderItems = EOrderItems::where('e_order_id', $quote->e_order_id)->get();
        $collection = Qoute::where(['id' => $quote->id, 'supplier_business_id' => \auth()->user()->business_id])->first();

        return view('supplier.singleCategoryRFQ.viewById', compact('quote', 'eOrderItems','collection', 'user_business_id'));
    }

    ###################################################################################################
}
