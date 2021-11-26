<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryComment;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /* Super Admin Functions starts */

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
        ],[
            'rating.required' => __('portal.Rating is required')
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        if ($request->rating < 4)
        {
            if ($request->rating < 4 && $request->comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
        }

        $request->merge(['comment_type' => 7]);

        DeliveryComment::create($request->all());

        Delivery::where('rfq_no', $request->rfq_no)->update([
            'emdad_buyer_rating' => 1
        ]);

        session()->flash('message', __('portal.Rated Buyer Successfully!'));
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
        ],[
            'rating.required' => __('portal.Rating is required')
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        if ($request->rating < 4)
        {
            if ($request->rating < 4 && $request->comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
        }

        $request->merge(['comment_type' => 8]);

        DeliveryComment::create($request->all());

        Delivery::where('rfq_no', $request->rfq_no)->update([
            'emdad_supplier_rating' => 1
        ]);

        session()->flash('message', __('portal.Rated Supplier Successfully!'));
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
                $supplierDeliveryComments[] = $deliveryCommentCollection->merge(['userID' => $delivery->supplier_user_id]);
            }
        }

        return view('rating.superAdmin.supplier.index', compact('supplierDeliveryComments'));
    }

    /* Super Admin Functions ends */

    /* Buyer Functions starts */

    public function buyerDeliveryIndex()
    {
        $collection = Delivery::where('business_id', auth()->user()->business_id)->get();
        $deliveries = $collection->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.buyer.deliveries.index', compact('deliveries'));
    }

    public function buyerRatingView()
    {
        return view('rating.buyer.view');
    }

    public function buyerDeliveryViewByID($id)
    {
        $comment_type = [1,5,7];
        $deliveryComments = DeliveryComment::with('user')->where('delivery_id', decrypt($id))->whereIn('comment_type', $comment_type)->orderByDesc('created_at')->get();

        return view('rating.buyer.deliveries.viewByID', compact('deliveryComments'));
    }

    public function buyerRatedToDeliveries()
    {
//        $collections = DeliveryComment::where('comment_type', 2)->orWhere('comment_type', 3)->orWhere('comment_type', 4)->get();
//        $deliveryComments = $collections->unique('delivery_id');
        $collections = Delivery::where('buyer_rating', 1)->get();
        $deliveries = $collections->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.buyer.deliveries.rated', compact('deliveries'));
    }

    public function buyerRatedViewByID($id)
    {
        $comment_type = [2,3,4];
        $deliveryComments = DeliveryComment::with('user')
                                            ->where('delivery_id' , decrypt($id))
                                            ->whereIn('comment_type', $comment_type)
                                            ->get();

        return view('rating.buyer.deliveries.buyerRatedViewByID', compact('deliveryComments'));
    }

    public function buyerUnRatedDeliveries()
    {
        $collection = Delivery::where(['status' => 1, 'buyer_rating' => 0])->get();
        $deliveries = $collection->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.buyer.deliveries.unrated', compact('deliveries'));
    }

    public function deliveriesListToRate()
    {
        $collections = Delivery::where('status',1)->where('buyer_rating', 0)->get();
        $deliveries = $collections->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.buyer.deliveries.list', compact('deliveries'));
    }

    public function createDeliveryRating($supplierID,$driverID,$deliveryID)
    {
        $supplier = User::where('id', decrypt($supplierID))->first();
        $driver = User::where('id', decrypt($driverID))->first();

        return view('rating.buyer.deliveries.create', compact('supplier','driver', 'deliveryID'));
    }

    public function saveBuyerRatedToDelivery(Request $request)
    {
        $validated = \Validator::make($request->all(),[
            'supplier_rating' => 'required',
            'driver_rating' => 'required',
            'emdad_rating' => 'required',
        ],
            [
                'supplier_rating.required' => __('portal.Supplier rating is required'),
                'driver_rating.required' => __('portal.Driver rating is required'),
                'emdad_rating.required' => __('portal.Emdad rating is required'),
            ]
        );

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        if ($request->supplier_rating < 4 || $request->driver_rating < 4 || $request->emdad_rating < 4)
        {
            if ($request->supplier_rating < 4 && $request->supplier_comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
            if ($request->driver_rating < 4 && $request->driver_comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
            if ($request->emdad_rating < 4 && $request->emdad_comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
        }

        DeliveryComment::create([
            'delivery_id' => decrypt($request->delivery_id),
            'user_id' => \Auth::id(),
            'business_id' => \Auth::user()->business_id,
            'comment_content' => $request->supplier_comment_content,
            'comment_type' => 3,
            'rating' => $request->supplier_rating,
        ]);
        DeliveryComment::create([
            'delivery_id' => decrypt($request->delivery_id),
            'user_id' => \Auth::id(),
            'business_id' => \Auth::user()->business_id,
            'comment_content' => $request->driver_comment_content,
            'comment_type' => 2,
            'rating' => $request->driver_rating,
        ]);
        DeliveryComment::create([
            'delivery_id' => decrypt($request->delivery_id),
            'user_id' => \Auth::id(),
            'business_id' => \Auth::user()->business_id,
            'comment_content' => $request->emdad_comment_content,
            'comment_type' => 4,
            'rating' => $request->emdad_rating,
        ]);

        Delivery::where('rfq_no', decrypt($request->rfq_no))->update([
            'buyer_rating' => 1
        ]);

        session()->flash('message', __('portal.Delivery Rated Successfully!!'));
        return redirect()->route('deliveriesListToRate');
    }

    /* Buyer Functions ends */

    /* Supplier Functions starts */

    public function supplierDeliveryIndex()
    {
        $collection = Delivery::where('supplier_business_id', auth()->user()->business_id)->get();
        $deliveries = $collection->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.supplier.deliveries.index', compact('deliveries'));
    }

    public function supplierRatingView()
    {
        return view('rating.supplier.view');
    }

    public function supplierDeliveryViewByID($id)
    {
        $comment_type = [2,3,8];
        $deliveryComments = DeliveryComment::with('user')->where('delivery_id', decrypt($id))->whereIn('comment_type', $comment_type)->orderByDesc('created_at')->get();

        return view('rating.supplier.deliveries.viewByID', compact('deliveryComments'));
    }

    public function supplierRatedToDeliveries()
    {
        $collections = Delivery::where('supplier_rating', 1)->get();
        $deliveries = $collections->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.supplier.deliveries.rated', compact('deliveries'));
    }

    public function supplierRatedViewByID($id)
    {
        $comment_type = [5,6];
        $deliveryComments = DeliveryComment::with('user')
            ->where('delivery_id' , decrypt($id))
            ->whereIn('comment_type', $comment_type)
            ->get();

        return view('rating.supplier.deliveries.supplierRatedViewByID', compact('deliveryComments'));
    }

    public function supplierUnRatedDeliveries()
    {
        $collection = Delivery::where(['status' => 1, 'supplier_rating' => 0])->get();
        $deliveries = $collection->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.supplier.deliveries.unrated', compact('deliveries'));
    }

    public function supplierDeliveriesListToRate()
    {
        $collections = Delivery::where('status',1)->where('supplier_rating', 0)->get();
        $deliveries = $collections->unique('rfq_no')->sortByDesc('created_at');

        return view('rating.supplier.deliveries.list', compact('deliveries'));
    }

    public function createDeliveryRatingBySupplier($supplierID,$deliveryID)
    {
        $buyer = User::where('id', decrypt($supplierID))->first();

        return view('rating.supplier.deliveries.create', compact('buyer', 'deliveryID'));
    }

    public function saveSupplierRatedToDelivery(Request $request)
    {
        $validated = \Validator::make($request->all(),[
            'buyer_rating' => 'required',
            'emdad_rating' => 'required',
        ],
            [
                'buyer_rating.required' => __('portal.Supplier rating is required'),
                'emdad_rating.required' => __('portal.Emdad rating is required'),
            ]
        );

        if ($validated->fails()) {
            return redirect()->back()->withInput()->withErrors($validated->errors());
        }

        if ($request->buyer_rating < 4 || $request->emdad_rating < 4)
        {
            if ($request->buyer_rating < 4 && $request->buyer_comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
            if ($request->emdad_rating < 4 && $request->emdad_comment_content == null)
            {
                session()->flash('error', __('portal.Enter comments for rating under 4'));
                return redirect()->back()->withInput();
            }
        }

        DeliveryComment::create([
            'delivery_id' => decrypt($request->delivery_id),
            'user_id' => \Auth::id(),
            'business_id' => \Auth::user()->business_id,
            'comment_content' => $request->buyer_comment_content,
            'comment_type' => 5,
            'rating' => $request->buyer_rating,
        ]);
        DeliveryComment::create([
            'delivery_id' => decrypt($request->delivery_id),
            'user_id' => \Auth::id(),
            'business_id' => \Auth::user()->business_id,
            'comment_content' => $request->emdad_comment_content,
            'comment_type' => 6,
            'rating' => $request->emdad_rating,
        ]);

        Delivery::where('rfq_no', decrypt($request->rfq_no))->update([
            'supplier_rating' => 1
        ]);

        session()->flash('message', __('portal.Rated Delivery Successfully!'));
        return redirect()->route('supplierDeliveriesListToRate');
    }

    /* Supplier Functions ends */

}
