<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmpleadosTabel extends Migration
{
    public  function up() {
      Schema::create('empleados', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('firstname');
        $table->string('lastname');
        $table->date('date_of_birth');
        $table->decimal('salary', 8, 2);
        $table->timestamps();
      });
    }
    public function down() {
        Schema::drop('empleados');
    }
}
