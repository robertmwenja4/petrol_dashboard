<?php

namespace App\Http\Controllers\cash;

use App\Models\pump\Pump;
use Illuminate\Http\Request;
use App\Models\cash\GiveCash;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GiveCashController extends Controller
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
        $pumps = Pump::where('status', 'active')->get()->pluck('name', 'id');
        $data = checkShift();
        $shift = $data["shift"];


        if (!$shift) {
            $date = date('Y-m-d');
            // Instead of view, return the route with parameters
            return route('shift.create', compact('date'));
        } else {
            if ($shift->status == 'pending') {
                return redirect()->route('shift.index');
                // return view('shifts.index', compact('shift', 'users'));
            } else if ($shift->status == 'open') {
                return view('give_cash.create', compact('pumps', 'shift'));
            } else if ($shift->status == 'closed') {
                $date = date('Y-m-d', strtotime("+1 day"));

                return redirect()->route('shift.index');
            }
        }
        // return view('give_cash.create', compact('pumps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, GiveCash $giveCash)
    {
        $data = $request->except('_token');
        $tid = $giveCash->max('tid');
        $data['tid'] = $tid + 1;
        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key',
                'data' => null
            ];
        }
        if ($validate) {

            try {
                DB::beginTransaction();

                $data['user_id'] = $checkuser['user_id'];

                $sale = GiveCash::create($data);


                if ($sale) {
                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Cash Record Created Successfully',
                        'data' => $sale
                    ];
                }
            } catch (\Exception $e) {

                DB::rollback();
                $output = [
                    'success' => false,
                    'msg' => 'Error Creating Cash Record ',
                    'data' => null
                ];
            }
        }

        return $output;
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
