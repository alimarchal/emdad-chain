<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Logistic;
use App\Notifications\verifyEmail;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LogisticController extends Controller
{
    use PasswordValidationRules;
    use Authenticatable;
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
        return view('logistic.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'gender' => ['required', 'string', 'max:10'],
            'policy_procedure' => ['required'],
            'name' => ['required', 'string', 'max:55'],
            'nid_num' => ['required', 'string', 'max:10'],
            'nid_exp_date' => ['required', 'date'],
            'mobile' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $time = strtotime($request->nid_exp_date);
        $newformat = date('Y-m-d',$time);
        $request->merge(['nid_exp_date' => $newformat]);

        $request->merge(['mobile' => str_replace(' ','',$request->mobile)]);
        $request->merge(['mobile' => str_replace('(','',$request->mobile)]);
        $request->merge(['mobile' => str_replace(')','',$request->mobile)]);
        $request->merge(['mobile' => str_replace('-','',$request->mobile)]);
        $request->merge(['password' =>  Hash::make($request->password)]);


        $verifyToken = sha1(rand(1,100));

        $logistic = Logistic::create($request->all());


        $logistic->notify(new verifyEmail($logistic));

        \auth()->guard('ire')->login($logistic);
        return redirect()->route('ireEmailVerify');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function show(Logistic $logistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistic $logistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistic $logistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistic $logistic)
    {
        //
    }
}
