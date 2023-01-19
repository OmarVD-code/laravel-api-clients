<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{
  
    public function index()
    {
        return Payment::all();
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {   
        try {
            $payment = DB::select("SELECT * FROM payments WHERE client_id = ".$id);
            return $payment;
        } catch (\Throwable $th) {
            return response()->json($th,500);
        }

    }

    
    public function update(Request $request, Payment $payment)
    {
        //
    }

   
    public function destroy(Payment $payment)
    {
        //
    }
}
