<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShopsOwnerRelation extends Migration
{
    public function up()
    {
        Schema::table('shops', function (Blueprint $table){
            $table->foreign('owner_id')
                ->references('id')
                ->on('barbers')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('shops', function (Blueprint $table){
            $table->dropForeign(['owner_id']);
        });
    }
}
