<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        $var = "
            CREATE PROCEDURE `delete_client`(IN client_id INT)
            BEGIN
                DELETE FROM clients WHERE id=client_id;
            END;
        ";

        DB::select($var);
    }

   
    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS delete_client";
        DB::SELECT($var);
    }
};
