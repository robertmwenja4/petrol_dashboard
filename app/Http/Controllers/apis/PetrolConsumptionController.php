<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\pump\Pump;

class PetrolConsumptionController extends Controller
{
    //fetch pumps
    public function fetchPumps()
    {
        try {
            $pumps = Pump::all();
            $response = response()->json(['msg' => null, 'data' => $pumps, 'success' => true], 200);
        } catch (Exception $e) {
            $response = response()->json(['msg' => $e->getMessage(), 'data' => null, 'success' => false], 422);
        }
        return $response;
    }
}
