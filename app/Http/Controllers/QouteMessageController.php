<?php

namespace App\Http\Controllers;

use App\Models\Qoute;
use App\Models\QouteMessage;
use Illuminate\Http\Request;

class QouteMessageController extends Controller
{
    public function store(Request $request)
    {
        /* Inserting eOrderItemsID in qoute_id while Storing Supplier message and Inserting QuoteID in qoute_id while storing Buyer message */
        $message = QouteMessage::create($request->all());
        session()->flash('message', 'Message successfully send.');
        return redirect()->back();
    }
}
