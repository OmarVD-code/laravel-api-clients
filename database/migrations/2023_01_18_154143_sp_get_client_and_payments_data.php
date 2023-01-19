<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
 
    public function up()
    {
        $sp = "
            CREATE PROCEDURE `get_clients_and_payments`(IN client_id INT)
            BEGIN
                select C.*, json_arrayagg(json_object('id', p.id,'transaction_id', p.transaction_id, 'amount', p.amount, 'date', p.`date`)) as payments
                from clients C
                join payments P 
                on C.id = p.client_id 
                where c.id = client_id
                group by c.id
                ;
            END;
        ";

        DB::select("DROP PROCEDURE IF EXISTS get_clients_and_payments;");

        DB::select($sp);
    }

   
    public function down()
    {
        $query = "DROP PROCEDURE IF EXISTS get_clients_and_payments";
        DB::SELECT($query);
    }
};
