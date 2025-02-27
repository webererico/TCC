<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('descricao');
            $table->string('status');
            $table->string('statusUmid');
            $table->float('spTemp');
            $table->float('minTemp')->nullable();
            $table->float('maxTemp')->nullable();
            $table->float('minUmid')->nullable();
            $table->float('maxUmid')->nullable();
            $table->dateTime('startTemp')->nullable();
            $table->dateTime('stopTemp')->nullable();
            $table->dateTime('startUmid')->nullable();
            $table->dateTime('stopUmid')->nullable();
            $table->float('spUmid');
            $table->timestamps();
        });

        DB::table('ambientes')->insert([
        ['id' => 1,'nome' => 'sala1','descricao' => 'Sala Auxiliar 1','status' => 'manual','statusUmid'=>'manual','spTemp' => 25.6,'spUmid' => 65.0, 'maxTemp'=>28, 'minTemp'=>20, 'maxUmid'=>80, 'minUmid'=>30],
        ['id' => 2,'nome' => 'sala2','descricao' => 'Sala Auxiliar 2','status' => 'manual','statusUmid'=>'manual','spTemp' => 24,'spUmid' => 60.0, 'maxTemp'=>28, 'minTemp'=>20, 'maxUmid'=>80, 'minUmid'=>30],
        ['id' => 3,'nome' => 'Laboratório','descricao' => 'Laboratório de Ensaios','status' => 'automatico','statusUmid'=>'manual','spTemp' => 23.0,'spUmid' => 70,'minTemp'=>20 , 'maxTemp'=>25,'minUmid'=>60, 'maxUmid'=>80],
        ['id' => 4,'nome' => 'Exterior','descricao' => 'Exterior','status' => 'manual','statusUmid'=>'manual','spTemp' => 0,'spUmid' => 0,'minTemp'=>0 , 'maxTemp'=>0,'minUmid'=>0, 'maxUmid'=>0]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambientes');
    }
}
