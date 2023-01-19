<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   
    public function up()
    {
        $var = "
            CREATE PROCEDURE get_all_clients()
            BEGIN     
                SELECT C.id, C.name, C.dob, C.phone, C.email, C.address, COUNT(P.client_id) AS payments, SUM(P.amount) AS total 
                FROM clients C 
                LEFT JOIN payments P ON C.id = P.client_id 
                GROUP BY C.id;
            END;
        ";

        DB::select($var);
    }

    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS get_all_clients";
        DB::SELECT($var);
    }
};
