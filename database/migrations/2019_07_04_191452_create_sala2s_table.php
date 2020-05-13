<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSala2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sala2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('spTemp');
            $table->float('spUmid');
            $table->float('umid');
            $table->float('temp');
            $table->float('eUmid');
            $table->float('eTemp');
            $table->float('maxTemp')->nullable();
            $table->float('minTemp')->nullable();
            $table->float('maxUmid')->nullable();
            $table->float('minUmid')->nullable();
            $table->float('energia')->nullable();
            $table->timestamps();
        });
        DB::table('sala2s')->insert([
            ['id' => 1,'spTemp' => '1','spUmid' => '1','umid' => '1','temp'=>'1','eUmid' => 1,'eTemp' => 1, 'maxTemp'=>28, 'minTemp'=>20, 'maxUmid'=>80, 'minUmid'=>30, 'energia'=> 0, 'created_at'=>'2019-11-03 18:55:01']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sala2s');
    }
}
