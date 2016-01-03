<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function($table)
        {
            $table->increments('id');
            $table->string('spamOrClient');
            $table->integer('discount');
            $table->string('lastName');
            $table->string('firstName');
            $table->string('surName');
            $table->string('nickName');
            $table->integer('nowPoints');
            $table->string('state');
            $table->string('birthDate');
            $table->string('mobNum');
            $table->integer('allPoints');
            $table->integer('overallPoints');
            $table->string('photo',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
