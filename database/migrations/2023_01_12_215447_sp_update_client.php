<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
    {
        $var = "
            CREATE PROCEDURE `update_client`(IN new_name VARCHAR(255), IN new_dob DATE, IN new_phone VARCHAR(255), IN new_email VARCHAR(255), IN new_address VARCHAR(255), IN client_id INT)
            BEGIN
                UPDATE clients SET name=new_name, dob=new_dob, phone=new_phone, email=new_email, address=new_address WHERE id=client_id;
            END;
        ";

        DB::select($var);
    }

   
    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS update_client";
        DB::SELECT($var);
    }
};
