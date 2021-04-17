<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShopsOwnerRelation extends Migration
{
    public function up()
    {
        Schema::table('shops', function (Blueprint $table){
            $table->foreign('owner')->references('id')->on('users');
        });
    }

    public function down()
    {
        //
    }
}
