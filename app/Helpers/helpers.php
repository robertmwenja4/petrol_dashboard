<?php

use App\Models\User;
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
