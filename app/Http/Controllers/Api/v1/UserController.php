<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::paginate(10);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['message' => 'Not Found!'], 404);
        } else {
            return $user;
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
        $token = $request->code;
        if ($token == "RRNirxFh4j9Ftd") {
            $user = User::find($id);
            $user->driver_status = $request->driver_status;
            $user->save();
            return $user;
        } else {
            return response()->json(['message' => 'Not Found!'], 404);
        }
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

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'email' => ['The provided credentials are incorrect.'],
            ], 404);
        }

        $user = User::where('email', $request->email)->first();

        return $user;
    }
}
