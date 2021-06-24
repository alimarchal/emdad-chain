<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\DeliveryComment;
use Illuminate\Http\Request;

class DeliveryCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = env('API_TOKEN');
        if ($token == "RRNirxFh4j9Ftd") {
            if ($request->has('status')) {
                $collection = DeliveryComment::where('comment_type', $request->comment_type)->get();
                if ($collection->isEmpty()) {
                    return response()->json(['message' => 'Not Found!'], 404);
                } else {
                    return $collection;
                }
            }
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
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
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $rating = DeliveryComment::create($request->all());
            return response()->json($rating, 201);
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
    public function show(Request $request, $id)
    {
        $token = env('API_TOKEN');

        if ($token == $request->code) {
            $collection = DeliveryComment::find($id);
            if (empty($collection)) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return $collection;
            }
        } else {
            return response()->json(['message' => 'UnAuthorized Access!'], 403);
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


    public function getRatingByUserID(Request $request, $user_id, $delivery_id)
    {
        $token = env('API_TOKEN');
        if ($token == $request->code) {
            $collection = DeliveryComment::where('user_id', $user_id)->where('delivery_id', $delivery_id)->get();
            if ($collection->isEmpty()) {
                return response()->json(['message' => 'Not Found!'], 404);
            } else {
                return response()->json($collection, 200);
            }
        } else {
            return response()->json(['message' => 'UnAuthorized Access!'], 403);
        }
    }


}
