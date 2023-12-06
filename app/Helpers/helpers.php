<?php

use App\Models\User;
use App\Models\shift\Shift;
use App\Models\shift\ShiftItem;
use Illuminate\Support\Facades\Hash;

// modify input array
function modify_array(array $input)
{
    $output = [];
    foreach ($input as $key => $list) {
        foreach ($list as $i => $v) {
            $output[$i][$key] = $v;
        }
    }
    return $output;
}

// auto-generate a 4 digit number prefixed with a string e.g ID-0001
function gen4tid($prefix = '', $num = 0, $count = 5)
{
    if ($prefix && $num) return $prefix . sprintf('%0' . $count . 'd', $num);
    return sprintf('%0' . $count . 'd', $num);
}

function verifyUser($passkey)
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



    $ouput = ['status' => $valid, 'user_id' => $user_id];

    return $ouput;
}

function checkShift()
{
    $shift = Shift::whereHas('items')
        ->with('items.pump', 'items.user', 'user')
        ->whereDate('shift_name', '=', date('Y-m-d'))
        ->orWhereDate('shift_name', '=', date('Y-m-d', strtotime("+1 day")))
        ->orderBy('id', 'desc')
        ->first();

    // $shiftUsers = ShiftItem::where('shift_id', $shift->id)->whereNotNull('user_id')->pluck('user_id')->toArray();


    // $users = User::whereNotIn('id', $shiftUsers)->whereHas('role', function ($q) {
    //     $q->where('type', 'attendant');
    // })
    //     ->pluck('name', 'id');
    $users = User::where('status', 'active')->whereHas('role', function ($q) {
        $q->where('type', 'attendant');
    })
        ->pluck('name', 'id');

    return ["shift" => $shift, "users" => $users];
}

