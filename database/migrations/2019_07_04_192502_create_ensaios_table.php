<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnsaiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensaios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->datetime('dataI');
            $table->datetime('dataF');
            $table->bigInteger('id_ambiente')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->date('data');
            $table->timestamps();   
        });
        Schema::table('ensaios', function($table) {
            $table->foreign('id_ambiente')->references('id')->on('ambientes');
            $table->foreign('id_user')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensaios');
    }
}
