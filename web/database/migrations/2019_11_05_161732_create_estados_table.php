<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_ambiente')->unsigned();
            $table->string('status');
            $table->string('statusWeb')->nullable();
            $table->string('modo');
            $table->string('temp');
            $table->timestamps();
        });
        Schema::table('estados', function($table) {
            $table->foreign('id_ambiente')->references('id')->on('ambientes');
        });
        DB::table('estados')->insert([
            ['id' => 1,'id_ambiente' => '1','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01'],
            ['id' => 2,'id_ambiente' => '1','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01'],
            ['id' => 3,'id_ambiente' => '2','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01'],
            ['id' => 4,'id_ambiente' => '2','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01'],
            ['id' => 5,'id_ambiente' => '3','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01'],
            ['id' => 6,'id_ambiente' => '3','status' => 'desligado','modo' => 'resfriar','temp'=>'1','created_at'=>'2019-11-03 18:55:01']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
