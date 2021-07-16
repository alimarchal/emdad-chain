<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryComment;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $collection = Delivery::all();
        $deliveries = $collection->unique('rfq_no');

        return view('rating.superAdmin.deliveries.index', compact('deliveries'));
    }

    public function view()
    {
        return view('rating.superAdmin.view');
    }

    public function viewByID($id)
    {
        $deliveryComments = DeliveryComment::with('user')->where('delivery_id', $id)->get();

        return view('rating.superAdmin.deliveries.viewByID', compact('deliveryComments'));
    }

    public function buyerList()
    {
        $deliveries = Delivery::where('status',1)->where('emdad_buyer_rating', 0)->get();

        /*$collections = Delivery::where('status',1)->pluck('id')->all();

        $deliveries = DeliveryComment::whereIn('delivery_id', $collections)->where('comment_type', 7)->get();
        if (count($deliveries) > 0)
        {
            $deliveries = collect();
            return view('rating.superAdmin.buyer.list', compact('deliveries'));
        }

        $deliveries = Delivery::with('buyer')->where('status',1)->get();*/

        return view('rating.superAdmin.buyer.list', compact('deliveries'));
    }

    public function createBuyerRating($id,$deliveryID)
    {
        $buyer = User::where('id', $id)->first();

        return view('rating.superAdmin.buyer.create', compact('buyer', 'deliveryID'));
    }

    public function saveBuyerRating(Request $request)
    {
        $validated = \Validator::make($request->all(),[
            'rating' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        $request->merge(['comment_type' => 7]);

        DeliveryComment::create($request->all());

        Delivery::where('rfq_no', $request->rfq_no)->update([
            'emdad_buyer_rating' => 1
        ]);

        session()->flash('message', 'Rated Buyer Successfully!!');
        return redirect()->route('buyerList');
    }

    public function supplierList()
    {
        $deliveries = Delivery::where('status',1)->where('emdad_supplier_rating', 0)->get();
        /*$collections = Delivery::where('status',1)->pluck('id')->all();

        $deliveries = DeliveryComment::whereIn('delivery_id', $collections)->where('comment_type', 8)->get();
        if (count($deliveries) > 0)
        {
            $deliveries = collect();
            return view('rating.superAdmin.supplier.list', compact('deliveries'));
        }

        $deliveries = Delivery::with('supplier')->where('status',1)->get();*/

        return view('rating.superAdmin.supplier.list', compact('deliveries'));
    }

    public function createSupplierRating($id,$deliveryID)
    {
        $supplier = User::where('id', $id)->first();

        return view('rating.superAdmin.supplier.create', compact('supplier', 'deliveryID'));
    }

    public function saveSupplierRating(Request $request)
    {
        $validated = \Validator::make($request->all(),[
            'rating' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        $request->merge(['comment_type' => 8]);

        DeliveryComment::create($request->all());

        Delivery::where('rfq_no', $request->rfq_no)->update([
            'emdad_supplier_rating' => 1
        ]);

        session()->flash('message', 'Rated Supplier Successfully!!');
        return redirect()->route('supplierList');
    }

    public function emdadRated()
    {
        $collections = DeliveryComment::where('comment_type', 7)->orWhere('comment_type', 8)->get();
        $deliveryComments = $collections->unique('delivery_id');

        return view('rating.superAdmin.deliveries.emdadRatings.rated', compact('deliveryComments'));
    }

    public function emdadRatedViewByID($id)
    {
        $deliveryComments = DeliveryComment::with('user')->where(['delivery_id' => $id, 'comment_type' => 7])->orWhere('comment_type', 8)->get();

        return view('rating.superAdmin.deliveries.emdadRatings.emdadRatedViewByID', compact('deliveryComments'));
    }

    public function emdadUnRated()
    {
        $deliveries = Delivery::where('status',1)->where(function ($query){
            $query->where('emdad_buyer_rating', 0)
                ->orWhere('emdad_supplier_rating', 0);
        })->get();

        /*$collections = DeliveryComment::where('comment_type', 7)->get();
        $deliveryBuyerComments = $collections->unique('delivery_id');

        $collections = DeliveryComment::where('comment_type', 8)->get();
        $deliverySupplierComments = $collections->unique('delivery_id');

        $cols = DeliveryComment::all();
        $dels = $cols->unique('delivery_id');

        $true = [];
        foreach ($dels as $del)
        {
            $true[] =  DeliveryComment::where('delivery_id', $del->delivery_id)->where('comment_type', '=', 7)->first();
        }*/

        /*if (count($deliveryBuyerComments) > 0 && !$deliverySupplierComments)
        {
            $deliveryComments = collect();
            return view('rating.superAdmin.deliveries.emdadRatings.unrated', compact('deliveryComments'));
        }
        if (count($deliverySupplierComments) > 0 && !$deliveryBuyerComments)
        {
            $deliveryComments = collect();
            return view('rating.superAdmin.deliveries.emdadRatings.unrated', compact('deliveryComments'));
        }
        if (count($deliverySupplierComments) > 0 && count($deliveryBuyerComments) > 0)
        {
            $deliveryComments = collect();
            return view('rating.superAdmin.deliveries.emdadRatings.unrated', compact('deliveryComments'));
        }

        $collections = DeliveryComment::where('comment_type', '!=', 7)->orWhere('comment_type', '!=', 8)->get();
        $deliveryComments = $collections->unique('delivery_id');*/

        return view('rating.superAdmin.deliveries.emdadRatings.unrated', compact('deliveries'));
    }

    public function buyerRated()
    {
        $buyerDeliveryComments = [];

        /*$buyers = User::where('registration_type', '=', 'Buyer')->where('usertype', '=','CEO')->get();

        foreach ($buyers as $buyer)
        {
            $deliveryCommentBuyer = DeliveryComment::with('user')->where('user_id', $buyer->id)->first();
            if ($deliveryCommentBuyer)
            {
                $buyerDeliveryComments[] = $deliveryCommentBuyer;
            }
        }*/

        /*$deliveries = Delivery::where(['status'=> 1])->where(function ($query){
            $query->where(['driver_rating' => 1, 'supplier_rating'=> 1])
                ->where(['emdad_buyer_rating' => 0, 'emdad_supplier_rating' => 0])
                ->orWhere(['emdad_buyer_rating' => 1, 'emdad_supplier_rating' => 1])
                ->orWhere(['emdad_buyer_rating' => 0, 'emdad_supplier_rating' => 0])
                ->orWhere(['emdad_buyer_rating' => 1, 'emdad_supplier_rating' => 1]);
        })->get();*/

        $deliveries = Delivery::where('status', 1)->get();

        $comment_type = [1,5,7];
        foreach ($deliveries as $delivery)
        {
            $collection = DeliveryComment::where('delivery_id', $delivery->id)->whereIn('comment_type' , $comment_type)->get();
            if (count($collection) > 0)
            {
                $deliveryCommentCollection = collect($collection);
                $buyerDeliveryComments[] = $deliveryCommentCollection->merge(['userID' => $delivery->user_id]);
            }
        }

        return view('rating.superAdmin.buyer.index', compact('buyerDeliveryComments'));
    }

    public function supplierRated()
    {
        $supplierDeliveryComments = [];
        /*$suppliers = User::where('registration_type', '=', 'Supplier')->where('usertype', '=','CEO')->get();

        foreach ($suppliers as $supplier)
        {
            $deliveryCommentSupplier = DeliveryComment::with('user')->where('user_id', $supplier->id)->first();
            if ($deliveryCommentSupplier)
            {
                $supplierDeliveryComments[] = $deliveryCommentSupplier;
            }
        }*/

        /*$deliveries = Delivery::where(['status'=> 1])->where(function ($query){
            $query->where(['buyer_rating' => 1])
                ->where(['emdad_buyer_rating' => 0, 'emdad_supplier_rating' => 0])
                ->orWhere(['emdad_buyer_rating' => 1, 'emdad_supplier_rating' => 1])
                ->orWhere(['emdad_buyer_rating' => 0, 'emdad_supplier_rating' => 0])
                ->orWhere(['emdad_buyer_rating' => 1, 'emdad_supplier_rating' => 1]);
        })->get();*/

        $deliveries = Delivery::where('status', 1)->get();

        $comment_type = [3,8];
        foreach ($deliveries as $delivery)
        {
            $collection = DeliveryComment::where('delivery_id', $delivery->id)->whereIn('comment_type' , $comment_type)->get();
            if (count($collection) > 0)
            {
                $deliveryCommentCollection = collect($collection);
                $supplierDeliveryComments[] = $deliveryCommentCollection->merge(['userID' => $delivery->user_id]);
            }
        }

        return view('rating.superAdmin.supplier.index', compact('supplierDeliveryComments'));
    }

}
