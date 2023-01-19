<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $var = "
            CREATE PROCEDURE `update_payment`(IN new_transaction_id VARCHAR(255), IN new_amount FLOAT, IN new_date DATE, IN payment_id INT)
            BEGIN
                UPDATE payments SET transaction_id=new_transaction_id, amount=new_amount, date=new_date WHERE id=payment_id;
            END;
        ";

        DB::select($var);
    }

    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS update_payment";
        DB::SELECT($var);
    }
};
