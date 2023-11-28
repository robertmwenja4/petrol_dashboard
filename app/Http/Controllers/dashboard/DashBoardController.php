<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\customer\Customer;
use App\Models\sale\Sale;
use App\Models\product\Product;
use App\Models\pump\Pump;

class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $user = User::find($id);
            $sales = Sale::all();
            $customers = Customer::all();
            $products = Product::all();
            $pumps = Pump::all();
            $users = User::whereHas('role',function($q){
                $q->where('type','attendant');
            })
            ->whereHas('cash',function($q){
                $q->where('status','approved');
            })
            ->where('status','active')->get();
            // $user_cash = [];
            // foreach ($users as $user) {
            //     $user_cash[] = $user->cash->groupBy('pump_id')->map(function($q){
            //         $q->pump = $q->first()->pump ? $q->first()->pump->name :'';
            //         $q->amount = $q->sum('amount');
            //         return $q;
            //     });
            //     # code...
            // }
            // foreach (collect($user_cash) as $cash) {
            //     dd($cash);
            //     # code...
            // }
            $role = $user->role ? $user->role->name : '';
            $roleType = $user->role ? $user->role->type : '';

            // if ($roleType == 'admin') {
            //     return view('dashboard.index', compact('role','customers','sales','products','pumps','users'));
            // } else if ($roleType == 'user') {
            //     return view('users_dashboard.index');
            // } else {
            //     Auth::logout();
            //     return redirect()->back()->with('flash_error', 'Login In With Common Credentials !!');
            // }
            return view('dashboard.index', compact('role','customers','sales','products','pumps','users'));
        } else {
            return redirect()->route('login');
        }
    }

    public function user_dashboard(){
        return view('users_dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users_dashboard.index');
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
        //
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
}
