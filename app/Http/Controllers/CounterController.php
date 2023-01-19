<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterController extends Controller
{
    public function index()
    {
        try {
            $counter = DB::select("SELECT * FROM counters");
            return $counter;
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function update(Request $request, $id)
    {
        $params = [
            $request->counter,
            $id
        ];

        $stmt = "UPDATE counters SET counter = ? WHERE id = ?";

        try {
            DB::select($stmt, $params);
            return 'OK';
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
