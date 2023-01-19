<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        $var = "
            CREATE PROCEDURE `create_payments` (IN new_client_id INTEGER, IN new_transaction_id VARCHAR(255), IN new_amount FLOAT, IN new_date DATE)
            BEGIN
                INSERT INTO payments(client_id, transaction_id, amount, date) VALUES (new_client_id, new_transaction_id, new_amount, new_date);
            END;
        ";

        DB::select($var);
    }

 
    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS create_payments";
        DB::SELECT($var);
    }
};
