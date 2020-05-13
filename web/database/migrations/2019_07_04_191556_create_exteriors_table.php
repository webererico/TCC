<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExteriorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exteriors', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->float('umid');
            $table->float('temp');
            $table->float('energia')->nullable();
            $table->timestamps();
        });
        DB::table('exteriors')->insert([
            ['id' => 1,'umid' => '1','temp'=>'1','energia'=> 1, 'created_at'=>'2019-11-03 18:55:01']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exteriors');
    }
}
