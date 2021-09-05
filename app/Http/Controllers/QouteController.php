<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\DraftPurchaseOrder;
use App\Models\EOrderItems;
use App\Models\EOrders;
use App\Models\Qoute;
use App\Models\User;
use App\Notifications\QuotationSent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use League\CommonMark\Extension\SmartPunct\Quote;

class QouteController extends Controller
{
    public function store(Request $request)
    {
        $buyer_id = User::where('business_id', $request->business_id)->first();
        $request->merge(['user_id' => $buyer_id->id]);
        $request->merge(['qoute_status' => 'Qouted']);
        $request->merge(['status' => 'pending']);
        $total_amount = ($request->quote_quantity * $request->quote_price_per_quantity);
        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);
        $request->merge(['total_cost' => $sum]);

        /* Setting RFQ Type */
        $request->merge(['rfq_type' => 1]);

        $quote = Qoute::create($request->all());
        // sending mail for confirmation
        User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));
        $buyer_user_id = $quote->RFQ->user_id;
        // send mail to buyer also for receiving email
        User::find($buyer_user_id)->notify(new \App\Notifications\QuoteReceivedBuyer());

        /* Sending SMS to business email ID */
        $from = Business::where('id', $quote->business_id)->pluck('business_name')->first();
        $to = Business::where('id', $quote->supplier_business_id)->pluck('business_name')->first();

        $categoryName = Category::where('id', $quote->orderItem->item_code)->first();
        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

        User::send_sms('+966581382822', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );
        User::send_sms('+966555390920', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );
        User::send_sms('+966593388833', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );

        /* Notifying business@emdad-chain.com for Purchase order created */
        $userQuoted =  User::find(auth()->user()->id);
        Notification::route('mail', 'business@emdad-chain.com')
            ->notify(new QuotationSent($userQuoted, $quote));

        session()->flash('message', 'You have successfully quoted.');

        return redirect()->route('QoutedRFQQouted');
    }

    /* Saving Quotation response for Single Category RFQ */
    public function singleRFQQuotationStore(Request $request)
    {
        $buyer_id = User::where('business_id', $request->business_id)->first();
        $request->merge(['user_id' => $buyer_id->id]);
        $request->merge(['qoute_status' => 'Qouted']);
        $request->merge(['status' => 'pending']);

        $total_amount = 0;
        for ($i = 0; $i < count($request->quote_quantity); $i++)
        {
            $total_amount += $request->quote_quantity[$i] * $request->quote_price_per_quantity[$i];
        }

        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);

        $request->merge(['total_cost' => $sum]);

        /* Setting RFQ Type */
        $request->merge(['rfq_type' => 0]);

        if (isset($request->sample_information))
        {
            for ($i=0 ; $i < count($request->e_order_items_id); $i++)
            {
                $data = [
                    'user_id' => $request->user_id,
                    'supplier_business_id' => $request->supplier_business_id,
                    'supplier_user_id' => $request->supplier_user_id,
                    'e_order_id' => $request->e_order_id,
                    'e_order_items_id' => $request->e_order_items_id[$i],
                    'business_id' => $request->business_id,
                    'quote_quantity' => $request->quote_quantity[$i],
                    'quote_price_per_quantity' => $request->quote_price_per_quantity[$i],
                    'sample_information' => $request->sample_information[$i],
                    'sample_unit' => $request->sample_unit[$i],
                    'sample_security_charges' => $request->sample_security_charges[$i],
                    'sample_charges_per_unit' => $request->sample_charges_per_unit[$i],
                    'shipping_time_in_days' => $request->shipping_time_in_days,
                    'shipment_cost' => $request->shipment_cost,
                    'VAT' => $request->VAT,
                    'total_cost' => $request->total_cost,
                    'note_for_customer' => $request->note_for_customer[$i],
                    'qoute_status' => $request->qoute_status,
                    'warehouse_id' => $request->warehouse_id,
                    'rfq_type' => $request->rfq_type,
                    'status' => $request->status,
                ];

                $quote = Qoute::create($data);
            }
        }
        else
        {
            for ($i=0 ; $i < count($request->e_order_items_id); $i++)
            {
                $data = [
                    'user_id' => $request->user_id,
                    'supplier_business_id' => $request->supplier_business_id,
                    'supplier_user_id' => $request->supplier_user_id,
                    'e_order_id' => $request->e_order_id,
                    'e_order_items_id' => $request->e_order_items_id[$i],
                    'business_id' => $request->business_id,
                    'quote_quantity' => $request->quote_quantity[$i],
                    'quote_price_per_quantity' => $request->quote_price_per_quantity[$i],
                    'shipping_time_in_days' => $request->shipping_time_in_days,
                    'shipment_cost' => $request->shipment_cost,
                    'VAT' => $request->VAT,
                    'total_cost' => $request->total_cost,
                    'note_for_customer' => $request->note_for_customer[$i],
                    'qoute_status' => $request->qoute_status,
                    'warehouse_id' => $request->warehouse_id,
                    'rfq_type' => $request->rfq_type,
                    'status' => $request->status,
                ];

                $quote = Qoute::create($data);
            }
        }

        // sending mail for confirmation
        User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));
        $buyer_user_id = $quote->RFQ->user_id;
        // send mail to buyer also for receiving email
        User::find($buyer_user_id)->notify(new \App\Notifications\QuoteReceivedBuyer());


        /* Sending SMS to business email ID */
        $from = Business::where('id', $quote->business_id)->pluck('business_name')->first();
        $to = Business::where('id', $quote->supplier_business_id)->pluck('business_name')->first();

        $categoryName = Category::where('id', $quote->orderItem->item_code)->first();
        $parentName = Category::where('id', $categoryName->parent_id)->pluck('name')->first();

        User::send_sms('+966581382822', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );
        User::send_sms('+966555390920', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );
        User::send_sms('+966593388833', 'Supplier responded to a requisition.' . ' By: ' . $from . ', ' . ' To: ' . $to . ', ' . 'Cat: ' . $categoryName->name . '-' . $parentName . ', ' . 'Requisition #: ' . $quote->e_order_id );

        /* Notifying business@emdad-chain.com for Purchase order created */
        $userQuoted =  User::find(auth()->user()->id);
        Notification::route('mail', 'business@emdad-chain.com')
            ->notify(new QuotationSent($userQuoted, $quote));

        session()->flash('message', 'You have successfully quoted.');

        return redirect()->route('singleCategoryQuotedRFQQuoted');
    }

    public function update(Request $request, Qoute $qoute)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['qoute_status' => 'Modified']);
        $request->merge(['status' => 'pending']);
        $request->merge(['qoute_status_updated' => 'Modified']);

        $total_amount = ($request->quote_quantity * $request->quote_price_per_quantity);
        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);
        $request->merge(['total_cost' => $sum]);

        session()->flash('message', 'You have updated the quote.');
        $qoute->update($request->all());
        $quote = $qoute;
        $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));
        if (isset($request->single_rfq))
        {
            return redirect()->route('singleCategoryQuotedModifiedRFQ');
        }
        return redirect()->route('viewRFQs');
    }

    /* Updating Quotation response for Single Category RFQ */
    public function singleRFQQuotationUpdate(Request $request, Qoute $qoute)
    {
        $request->merge(['qoute_status' => 'Modified']);
        $request->merge(['qoute_status_updated' => 'Modified']);

        $total_amount = 0;
        for ($i = 0; $i < count($request->quote_quantity); $i++)
        {
            $total_amount += $request->quote_quantity[$i] * $request->quote_price_per_quantity[$i];
        }

        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);

        $request->merge(['total_cost' => $sum]);

        if (isset($request->sample_information))
        {
            for ($i=0 ; $i < count($request->e_order_items_id); $i++)
            {
                $data = [
                    'quote_quantity' => $request->quote_quantity[$i],
                    'quote_price_per_quantity' => $request->quote_price_per_quantity[$i],
                    'sample_information' => $request->sample_information[$i],
                    'sample_unit' => $request->sample_unit[$i],
                    'sample_security_charges' => $request->sample_security_charges[$i],
                    'sample_charges_per_unit' => $request->sample_charges_per_unit[$i],
                    'shipping_time_in_days' => $request->shipping_time_in_days,
                    'shipment_cost' => $request->shipment_cost,
                    'VAT' => $request->VAT,
                    'total_cost' => $request->total_cost,
                    'note_for_customer' => $request->note_for_customer[$i],
                    'qoute_status' => $request->qoute_status,
                    'qoute_status_updated' => $request->qoute_status_updated,
                ];

                Qoute::where(['e_order_items_id' => $request->e_order_items_id[$i], 'supplier_business_id' => auth()->user()->business_id])->update($data);
            }
        }
        else
        {
            for ($i=0 ; $i < count($request->e_order_items_id); $i++)
            {
                $data = [
                    'quote_quantity' => $request->quote_quantity[$i],
                    'quote_price_per_quantity' => $request->quote_price_per_quantity[$i],
                    'shipping_time_in_days' => $request->shipping_time_in_days,
                    'shipment_cost' => $request->shipment_cost,
                    'VAT' => $request->VAT,
                    'total_cost' => $request->total_cost,
                    'note_for_customer' => $request->note_for_customer[$i],
                    'qoute_status' => $request->qoute_status,
                    'qoute_status_updated' => $request->qoute_status_updated,
                ];

                Qoute::where(['e_order_items_id' => $request->e_order_items_id[$i], 'supplier_business_id' => auth()->user()->business_id])->update($data);
            }
        }

        session()->flash('message', 'You have updated the quote.');
        $quote = $qoute;
        User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteSend($quote));

        return redirect()->route('singleCategoryQuotedModifiedRFQ');
    }

    public function QoutedRFQQouted()
    {
        $user_id = auth()->user()->id;
//        $collection = Qoute::where(['supplier_user_id' => $user_id , 'rfq_type' => 1])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->orWhere('qoute_status', 'Modified')->get();
        $collection = Qoute::where(['supplier_user_id' => $user_id , 'rfq_type' => 1])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->get();

        return view('supplier.supplier-qouted', compact('collection'));
    }

    public function QuotedModifiedRFQ()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where(['supplier_user_id' => $user_id , 'rfq_type' => 1])->where(['qoute_status' => 'Modified'])->get();

        return view('supplier.supplier-modified-quoted-quotes', compact('collection'));
    }

    public function QoutedRFQRejected()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 1])->where('qoute_status_updated', 'Rejected')->get();
        return view('supplier.supplier-qouted-Rejected', compact('collection'));
    }

    public function QoutedRFQModificationNeeded()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 1])->where('qoute_status_updated', 'ModificationNeeded')->get();
        return view('supplier.supplier-qouted-ModificationNeeded', compact('collection'));
    }

    public function QoutedRFQQoutedRFQPendingConfirmation()
    {
        $user_id = auth()->user()->id;
        $collection = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 1])->where('qoute_status', 'RFQPendingConfirmation')->get();
        return view('supplier.supplier-qouted-PendingConfirmation', compact('collection'));
    }

    ################### Functions For Single Category RFQ Type For Supplier ##################

    public function singleCategoryQuotedRFQQuoted()
    {
        $user_id = auth()->user()->id;
        $quoted = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 0])->where([['qoute_status', 'Qouted'],['qoute_status_updated', null]])->get();
        $collection = $quoted->unique('e_order_id');

        return view('supplier.singleCategoryRFQ.supplier-qouted', compact('collection'));
    }

    public function singleCategoryQuotedModifiedRFQ()
    {
        $user_id = auth()->user()->id;
        $modified = Qoute::where(['supplier_user_id' => $user_id , 'rfq_type' => 0])->where(['qoute_status' => 'Modified'])->get();
        $collection = $modified->unique('e_order_id');

        return view('supplier.singleCategoryRFQ.supplier-modified-quoted-quotes', compact('collection'));
    }

    public function singleCategoryQuotedRFQRejected()
    {
        $user_id = auth()->user()->id;
        $rejected = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 0])->where('qoute_status_updated', 'Rejected')->get();
        $collection = $rejected->unique('e_order_id');

        return view('supplier.singleCategoryRFQ.supplier-qouted-Rejected', compact('collection'));
    }

    public function singleCategoryQuotedRFQModificationNeeded()
    {
        $user_id = auth()->user()->id;
        $modificationQuotes = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 0])->where('qoute_status_updated', 'ModificationNeeded')->get();
        $collection = $modificationQuotes->unique('e_order_id');
        return view('supplier.singleCategoryRFQ.supplier-qouted-ModificationNeeded', compact('collection'));
    }

    public function singleCategoryQuotedRFQPendingConfirmation()
    {
        $user_id = auth()->user()->id;
        $pending = Qoute::where(['supplier_user_id' => $user_id ,'rfq_type' => 0])->where('qoute_status', 'RFQPendingConfirmation')->get();
        $collection = $pending->unique('e_order_id');

        return view('supplier.singleCategoryRFQ.supplier-qouted-PendingConfirmation', compact('collection'));
    }

    ##########################################################################################

    public function QoutationsBuyerReceived()
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            $PlacedRFQ = EOrders::orderBy('created_at', 'desc')->get();
        } else {
//            $PlacedRFQ = EOrders::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
//            $PlacedRFQ = EOrders::where('business_id', auth()->user()->business_id)->orderBy('created_at', 'desc')->get();
//            $PlacedRFQ = EOrders::where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->orderBy('created_at', 'desc')->get();
            $PlacedRFQ = EOrders::with('OrderItems')->where(['business_id' => auth()->user()->business_id, 'rfq_type' => 1])->where('discard',0)->orderBy('created_at', 'desc')->get();
        }

        return view('buyer.receivedQoutations', compact('PlacedRFQ'));
    }

    /* Adding 3 more days to expired Multi category RFQs */
    public function resetQuotationTime($EOrderItemID)
    {
        EOrderItems::where('id', $EOrderItemID)->update(['quotation_time' => Carbon::now()->addDays(3)]);

        if (auth()->user()->rtl == 0)
        {
            session()->flash('message', __('portal.Quotation Time Reset Successfully!'));
        }
        else{
            session()->flash('message', __('portal.Quotation Time Reset Successfully!'));
        }
        return redirect()->route('QoutationsBuyerReceived');
    }

    /* Discarding expired Multi category RFQs */
    public function discardQuotation($EOrderID)
    {
        EOrders::where('id', $EOrderID)->update(['discard' => 1]);

        if (auth()->user()->rtl == 0)
        {
            session()->flash('message', __('portal.Quotation Discarded Successfully!'));
        }
        else{
            session()->flash('message', __('portal.Quotation Discarded Successfully!'));
        }
        return redirect()->route('QoutationsBuyerReceived');
    }

    public function QoutationsBuyerReceivedRFQItemsByID($EOrderItems)
    {
        $collection = EOrderItems::where('e_order_id', $EOrderItems)->orderBy('created_at', 'desc')->get();
        return view('buyer.byerItemsShow', compact('collection', 'EOrderItems'));
    }

    public function QoutationsBuyerReceivedQoutes($EOrderID, $EOrderItemID, $bypass_id)
    {
        $collection = EOrderItems::with('qoutes')->where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        if($bypass_id == 1)
        {
            $collection->update([
                'bypass' => 1
            ]);
        }
        return view('buyer.qoutes', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedRejected($EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutedRejected', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedModificationNeeded($EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.qoutationsBuyerReceivedModificationNeeded', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedAccepted($EOrderID, $EOrderItemID,$bypass_id)
    {
        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'desc')->first();
        return view('buyer.QoutationsBuyerReceivedAccepted', compact('collection', 'EOrderID', 'EOrderItemID', 'bypass_id'));
    }

    public function QoutationsBuyerReceivedQouteID(Qoute $QouteItem)
    {
        return view('buyer.qoutesrespond', compact('QouteItem'));
    }

    public function updateModificationNeeded(Qoute $qoute)
    {
        $qoute_status = 'ModificationNeeded';
        $qoute->update([
            'qoute_status' => $qoute_status,
            'qoute_updated_user_id' => auth()->user()->id,
            'qoute_status_updated' => $qoute_status,
            'status' => 'pending',
        ]);

        $buyer_id = 0;
        // inform supplier user
        $supplier_user = User::find($qoute->supplier_user_id)->notify(new \App\Notifications\QuoteAgain($qoute));
        session()->flash('message', 'Quote status changed to ' . $qoute_status);
        return redirect()->route('QoutationsBuyerReceivedModificationNeeded', [$qoute->e_order_id, $qoute->e_order_items_id, $buyer_id]);
    }

    public function updateRejected(Qoute $qoute)
    {
        $qoute_status = 'Rejected';
        $qoute->update([
//            'qoute_status' => $qoute_status,
            'qoute_updated_user_id' => auth()->user()->id,
            'qoute_status_updated' => $qoute_status,
            'status' => 'expired',
        ]);

        $quote = $qoute;
        $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteRejected($quote));
        session()->flash('message', 'Qoute status changes to ' . $qoute_status);
        return redirect()->route('QoutationsBuyerReceived');
    }

    public function qouteAccepted(Request $request, Qoute $qoute)
    {

        $request->merge(['po_date' => date('Y-m-d')]);
        $request->merge(['po_status' => 'pending']);
        $request->merge(['status' => 'pending']);
        $request->merge(['rfq_type' => 1]);
//        $dpo = null;

        try {
            DB::beginTransaction();
            $dpo = null;
            $dpoCheck = DraftPurchaseOrder::where('qoute_no',$request->qoute_no)->first();

            if (isset($dpoCheck))
            {
                $qoute_status = 'accepted';
                $qoute->update([
                    'qoute_status' => $qoute_status,
                    'qoute_status_updated' => $qoute_status,
                    'status' => 'completed',
                ]);
                $dpoCheck->update([
                    'po_status' => $qoute_status,
                    'status' => $qoute_status,
                ]);
                $dpo = $dpoCheck;
            }
            else
            {
                $dpo = null;
                $dpo = DraftPurchaseOrder::create($request->all());
                $qoute_status = 'accepted';
                $qoute->update([
                    'qoute_status' => $qoute_status,
                    'qoute_updated_user_id' => auth()->user()->id,
                    'qoute_status_updated' => $qoute_status,
                    'status' => 'completed',
                    'dpo' => $dpo->id,
                ]);
            }
            // $user = User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteAccepted($qoute));
            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
        }
        session()->flash('message', 'Draft purchase order has been generated');
        return redirect()->route('dpo.show', $dpo->id);
    }

    ################### Functions For Single Category RFQ Type For Buyer ##################

    public function singleCategoryBuyerRFQs()
    {
        $placedRFQs = EOrders::with('OrderItems')->where(['business_id' => auth()->user()->business_id, 'rfq_type' => 0])->where('discard',0)->orderBy('id', 'DESC')->get();

        return view('buyer.singleCategory.index', compact('placedRFQs'));
    }

    /* Adding 3 more days to expired single category RFQs */
    public function resetSingleCategoryQuotationTime($eOrderID)
    {
        EOrderItems::where('e_order_id', $eOrderID)->update(['quotation_time' => Carbon::now()->addDays(3)]);

        session()->flash('message', 'Quotation Time Reset Successfully!');
        return redirect()->route('singleCategoryBuyerRFQs');
    }

    /* Discarding expired single category RFQs */
    public function discardSingleCategoryQuotation($eOrderID)
    {
        EOrders::where('id', $eOrderID)->update(['discard' => 1]);

        session()->flash('message', 'Quotation Discarded Successfully!');
        return redirect()->route('singleCategoryBuyerRFQs');
    }

    public function singleCategoryRFQItems($rfq_id)
    {
        $RFQItems = EOrderItems::with('qoutes','category')->where(['e_order_id' => $rfq_id])->get();

        return view('buyer.singleCategory.rfq', compact('RFQItems'));
    }

    public function singleCategoryRFQItemByID(Qoute $quote)
    {
        $quotes = Qoute::where(['supplier_business_id' => $quote->supplier_business_id])->where( 'e_order_id' , $quote->e_order_id)->get();

        return view('buyer.singleCategory.respond', compact('quotes'));
    }

    public function singleCategoryRFQQuotationsBuyerReceived($eOrderID, $bypass_id)
    {
        $quotes = Qoute::with('orderItem')->where('e_order_id', $eOrderID)->orderBy('created_at', 'DESC')->get();
        $collection = $quotes->unique('supplier_user_id');

        if($bypass_id == 1)
        {
            foreach ($collection as $collect)
            {
                EOrderItems::where('e_order_id', $collect->e_order_id)->update([
                'bypass' => 1
                 ]);
            }
        }
        return view('buyer.singleCategory.quotation', compact('collection',  'eOrderID', 'bypass_id'));
    }

//    public function singleCategoryRFQQuotationsBuyerRejected($EOrderItemID,$bypass_id)
    public function singleCategoryRFQQuotationsBuyerRejected($eOrderID,$bypass_id)
    {
//        $collection = EOrderItems::where('id', $EOrderItemID)->orderBy('created_at', 'DESC')->first();
        $quotes = Qoute::where('e_order_id', $eOrderID)->orderBy('created_at', 'DESC')->get();
        $collection = $quotes->unique('supplier_user_id');

        return view('buyer.singleCategory.rejectedQuotation', compact('collection', 'eOrderID', 'bypass_id'));
    }

    public function singleCategoryRFQQuotationsModificationNeeded($eOrderID,$bypass_id)
    {
        $quotes = Qoute::where('e_order_id', $eOrderID)->orderBy('created_at', 'DESC')->get();
        $collection = $quotes->unique('supplier_user_id');
        return view('buyer.singleCategory.modifiedQuotation', compact('collection',  'eOrderID', 'bypass_id'));
    }

    public function singleCategoryRFQUpdateStatusModificationNeeded(Qoute $quotes)
    {
        $quote_status = 'ModificationNeeded';

        $relatedQuotes = Qoute::where(['supplier_user_id' => $quotes->supplier_user_id, 'e_order_id' => $quotes->e_order_id])->get();

        foreach ($relatedQuotes as $quote)
        {
            Qoute::where('id', $quote->id)->update([
                'qoute_status' => $quote_status,
                'qoute_updated_user_id' => auth()->user()->id,
                'qoute_status_updated' => $quote_status,
                'status' => 'pending',
            ]);
        }

        $buyer_id = 0;
        // inform supplier user
        User::find($quotes->supplier_user_id)->notify(new \App\Notifications\QuoteAgain($quotes));
        session()->flash('message', 'Quote status changed to ' . $quote_status);
        return redirect()->route('singleCategoryRFQQuotationsModificationNeeded', [$quote->e_order_id, $buyer_id]);
//        return redirect()->route('singleCategoryRFQQuotationsModificationNeeded', [$quote->e_order_items_id, $buyer_id]);
    }

    public function singleCategoryRFQUpdateStatusRejected(Qoute $quotes)
    {
        $quote_status = 'Rejected';

        $relatedQuotes = Qoute::where(['supplier_user_id' => $quotes->supplier_user_id, 'e_order_id' => $quotes->e_order_id])->get();

        foreach ($relatedQuotes as $quote)
        {
            Qoute::where('id', $quote->id)->update([
                'qoute_updated_user_id' => auth()->user()->id,
                'qoute_status_updated' => $quote_status,
                'status' => 'expired',
            ]);
        }

        User::find(auth()->user()->id)->notify(new \App\Notifications\QuoteRejected($quotes));
        session()->flash('message', 'Quote status changes to ' . $quote_status);
        return redirect()->route('singleCategoryBuyerRFQs');
    }

    public function singleCategoryQuoteAccepted(Request $request)
    {

        $request->merge(['po_date' => date('Y-m-d')]);
        $request->merge(['po_status' => 'pending']);
        $request->merge(['status' => 'pending']);
        $qoute_status = 'accepted';
        $quotes = Qoute::where(['e_order_id' => $request->e_order_id, 'supplier_business_id' => $request->supplier_business_id])->get();

        try {
            DB::beginTransaction();
            $dpoCheck = DraftPurchaseOrder::where('qoute_no',$request->qoute_no)->first();

            if (isset($dpoCheck))
            {
                foreach ($quotes as $quote)
                {
                    Qoute::where('id',$quote->id)->update([
                        'qoute_status' => $qoute_status,
                        'qoute_status_updated' => $qoute_status,
                        'status' => 'completed',
                    ]);
                }
                foreach ($quotes as $quote)
                {
                    DraftPurchaseOrder::where('qoute_no',$quote->id)->update([
                        'po_status' => $qoute_status,
                        'status' => $qoute_status,
                    ]);
                }
            }
            else
            {
                for ($i =0; $i<count($quotes); $i++)
                {
                    $data = [
                        'user_id' => $request->user_id,
                        'business_id' => $request->business_id,
                        'supplier_user_id' => $request->supplier_user_id,
                        'supplier_business_id' => $request->supplier_business_id,
                        'rfq_no' => $request->e_order_id,
                        'rfq_item_no' => $quotes[$i]->e_order_items_id,
                        'item_code' => $request->item_code,
                        'item_name' => $request->item_name,
                        'uom' => $quotes[$i]->orderItem->unit_of_measurement,
                        'brand' => $quotes[$i]->orderItem->brand,
                        'quantity' => $quotes[$i]->quote_quantity,
                        'unit_price' => $quotes[$i]->quote_price_per_quantity,
                        'sub_total' => $quotes[$i]->quote_quantity * $quotes[$i]->quote_price_per_quantity,
                        'delivery_time' => $request->delivery_time,
                        'qoute_no' => $quotes[$i]->id,
                        'warehouse_id' => $request->warehouse_id,
                        'shipment_cost' => $request->shipment_cost,
                        'vat' => $request->vat,
                        'total_cost' => $request->total_cost,
                        'payment_term' => $request->payment_term,
                        'remarks' => $request->remarks,
                        'delivery_address' => $request->delivery_address,
                        'address' => $request->address,
                        'otp_mobile_number' => $request->otp_mobile_number,
                        'po_date' => $request->po_date,
                        'po_status' => $request->po_status,
                        'status' => $request->status,
                        'rfq_type' => 0,
                    ];
                    $dpo = DraftPurchaseOrder::create($data)->id;

                    Qoute::where('id', $quotes[$i]->id)->update([
                        'qoute_status' => $qoute_status,
                        'qoute_updated_user_id' => auth()->user()->id,
                        'qoute_status_updated' => $qoute_status,
                        'status' => 'completed',
                        'dpo' => $dpo,
                    ]);
                }
            }
            DB::commit();
            /* Transaction successful. */
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
        }
        session()->flash('message', 'Draft purchase order has been generated');
//        return redirect()->route('singleCategoryIndex');
        return redirect()->route('singleCategoryDPOIndex');
    }

    ##########################################################################################

    // Calculating totalCost at the time of Supplier RFQ response
    public function totalCost(Request $request)
    {
        /* Old Total Cost Calculating Formula */
//        $total_cost = ($request->quote_quantity * $request->quote_price_per_quantity);
//        $total_vat = ($total_cost * ($request->VAT / 100));
//        $total_shipment = $request->shipment_cost;
//        $sum = ($total_cost + $total_vat + $total_shipment);

        /* NEW Total Cost Calculating Formula */
        $total_amount = ($request->quote_quantity * $request->quote_price_per_quantity);
        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);

        return response()->json(['data'=> $sum]);
    }

    // Calculating totalCost for Single Category RFQ Type at the time of Supplier RFQ response
    public function singleTotalCost(Request $request)
    {
        $total_amount = 0;
        for ($i = 0; $i < count($request->quantities); $i++)
        {
            $total_amount += $request->quantities[$i] * $request->prices[$i];
        }

        $total_cost = $total_amount + $request->shipment_cost;
        $total_vat = ($total_cost * ($request->VAT / 100));
        $sum = ($total_cost + $total_vat);

        return response()->json(['data'=> $sum]);
    }
}
