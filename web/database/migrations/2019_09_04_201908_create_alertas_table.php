<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_ambiente')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->boolean('avisoTemp')->nullable();
            $table->boolean('avisoUmid')->nullable();
            $table->timestamps();
        });
        Schema::table('alertas', function($table) {
            $table->foreign('id_ambiente')->references('id')->on('ambientes')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alertas');
    }
}
