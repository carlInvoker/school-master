<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLektorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lektor', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_surname',1024)->nullable();
      $table->longText('description', 1024)->nullable();
      $table->string('image',1024)->nullable();
      $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lektor');
    }
}
