<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function index()
    {
        try {
            $clients = DB::select('CALL get_all_clients()');
            return $clients;
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }


    public function store(Request $request)
    {
        $clientStmt = "CALL create_client(?,?,?,?,?)";
        $paymentStmt = "CALL create_payments(?,?,?,?)";

        $params = [
            $request->data['fname'] . ' ' . $request->data['lname'],
            $request->data['dob'],
            $request->data['phone'],
            $request->data['email'],
            $request->data['address']
        ];

        try {
            // create the client
            DB::SELECT($clientStmt, $params);

            // get the client 
            $client_id = DB::SELECT("CALL get_last_user()");

            // loop the payments and create
            foreach ($request->data['transactions'] as $tr) {
                $tr_params = [
                    $client_id[0]->value,
                    $tr['transaction_id'],
                    $tr['amount'],
                    $tr['date']
                ];

                DB::select($paymentStmt, $tr_params);
            }
            return 'OK';
            
        } catch (\Throwable $th) {
            return response()->json([$th, "Controller error"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = [$id];
            $stmt = "CALL get_clients_and_payments(?)";
            $client = DB::select($stmt, $params);
            return $client;
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }


    public function update(Request $request, $id)
    {
        $clientStmt = "CALL update_client(?,?,?,?,?,?)";
        $paymentStmt = "CALL update_payment(?,?,?,?)";

        $params = [
            $request->data['name'],
            $request->data['dob'],
            $request->data['phone'],
            $request->data['email'],
            $request->data['address'],
            $id
        ];

        try {
            DB::select($clientStmt, $params);

            foreach ($request->data['transactions'] as $tr) {
                $tr_params = [
                    $tr['transaction_id'],
                    $tr['amount'],
                    $tr['date'],
                    $tr['id']
                ];
                DB::select($paymentStmt, $tr_params);
            }

            return 'OK';
        } catch (\Throwable $th) {
            return response()->json($th,);
        }
    }


    public function destroy($id)
    {
        $params = [$id];
        $stmt = "CALL delete_client(?)";

        try {
            DB::select($stmt, $params);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function customMethod(Request $request)
    {
        return $request;
    }
}
