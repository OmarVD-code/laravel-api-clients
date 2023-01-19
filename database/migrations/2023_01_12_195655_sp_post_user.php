<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        $var = "
        CREATE PROCEDURE create_client(IN newName VARCHAR(255), IN newDob DATE, IN newPhone VARCHAR(255), 
        IN newEmail VARCHAR(255), IN newAddress VARCHAR(255))
        BEGIN
            INSERT INTO clients(name, dob, phone, email, address) VALUES (newName, newDob, newPhone, newEmail, newAddress);
        END;
        ";

        DB::select($var);
    }


    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS create_client";
        DB::SELECT($var);
    }
};
