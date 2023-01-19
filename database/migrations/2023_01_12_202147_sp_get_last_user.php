<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        $var = "
            CREATE PROCEDURE `get_last_user`()
            BEGIN
                SELECT MAX(id) as value FROM clients;
            END;
        ";

        DB::select($var);
    }

  
    public function down()
    {
        $var = "DROP PROCEDURE IF EXISTS get_last_user";
        DB::SELECT($var);
    }
};
