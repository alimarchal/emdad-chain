<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\DriverRating;
use Illuminate\Http\Request;

class DriverRatingController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DriverRating::create([
                'driver_user_id' => $request->driver_user_id,
                'buyer_business_id' => $request->buyer_business_id,
                'recommend' => $request->recommend,
                'rating' => $request->rating,
            ]);
            return response()->json($rating, 200);
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DriverRating::findOrFail($id);
            return response()->json($rating, 200);
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function driver_id(Request $request, $id)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DriverRating::where('driver_user_id',$id)->get();
            if ($rating->isNotEmpty()){
                return response()->json($rating, 200);
            } else {
                return response()->json($rating, 404);
            }
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }


    public function buyer_business_id(Request $request, $id)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DriverRating::where('buyer_business_id',$id)->get();
            if ($rating->isNotEmpty()){
                return response()->json($rating, 200);
            } else {
                return response()->json($rating, 404);
            }
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }


    public function buyer_business_id_average(Request $request, $id)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DriverRating::where('buyer_business_id',$id)->get();
            if ($rating->isNotEmpty()){
                $rating_sum = $rating->sum('rating');
                $rating_count = $rating->count();
                $average_rating = ($rating_sum / $rating_count);
                $average_rating = ['average_rating'=> $average_rating];
                return response()->json($average_rating, 200);
            } else {
                return response()->json($rating, 404);
            }
        } else {
            return response()->json(['message' => 'UnAuthorized access '], 403);
        }
    }
}
