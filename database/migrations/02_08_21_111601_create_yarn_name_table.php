<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('yarn_name', function (Blueprint $table) {
            $table->bigIncrements('yarn_name_id');
            $table->string('yarn_name');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('brand_id')->on('brand');
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
        Schema::dropIfExists('yarn_name');
    }
}
