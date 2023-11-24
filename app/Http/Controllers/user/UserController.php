<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.index', compact('roles', 'users'));
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
        // dd($request->all());
        $predefined_password = '12345678';
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Rule::unique('users'),
            ],
            'password' => 'required|string|min:8', // You can customize password requirements
        ];

        // Validate the request
        // dd($request->all(), $rules);
        // $request->validate($rules);
        // Create user
        $user = User::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            // 'fullname' => $request->input('fullname'),
            'code' => $request->input('code'),
            'phone_number' => $request->input('phone_number'),
            'role_id' => $request->input('role_id'),
            'password' => Hash::make($predefined_password),
        ]);
        return redirect()->back()->with('flash_success', 'User Created Successfully!!');
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
        return view('users.view', compact('user'));
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
        dd($request->all());
    }
    public function update_user(Request $request)
    {
        // dd($request->all());
        $data = $request->only([
            'fullname', 'email', 'phone_number', 'code', 'status', 'role_id', 'id'
        ]);
        $data['name'] = $data['fullname'];
        $user = User::find($data['id']);
        unset($data['fullname'], $data['id']);
        $user->update($data);
        return redirect()->back()->with('status', 'User Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('status', 'User Deleted Successfully!!');
    }

    public function verifyUser($passkey)
    {
        $users = User::where('status', 'active')->get();
        $valid = false;
        $user_id = null;
        foreach ($users as $user) {

            if ($user && Hash::check($passkey, $user->password)) {
                $valid = true;
                $user_id = $user->id;
                break;
            }
        }
        if ($valid) {
            return response(['message' => null, 'data' => $user_id], 200);
        } else {
            return response(['data' => null, 'message' => 'User does not exist'], 402);
        }
    }
}
