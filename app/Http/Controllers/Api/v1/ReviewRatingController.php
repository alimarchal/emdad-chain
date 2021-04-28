<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;

class ReviewRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $user_id = $request->user_id;
            $business_id = $request->business_id;
            $user = \App\Models\User::find($user_id);
            $business = \App\Models\Business::find($business_id);
            $rating = $business->rating([
                'title' => $request->title,
                'body' => $request->body,
                'customer_service_rating' => $request->customer_service_rating,
                'quality_rating' => $request->quality_rating,
                'friendly_rating' => $request->friendly_rating,
                'pricing_rating' => $request->pricing_rating,
                'rating' => $request->rating,
                'recommend' => 'Yes',
                'approved' => true, // This is optional and defaults to false
            ], $user);
            return response()->json($rating, 200);
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$business_id)
    {
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $business = \App\Models\Business::find($business_id);
            $business->averageRating();
            return response()->json($business->averageRating(), 200);
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
