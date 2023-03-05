<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYarnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::enableForeignKeyConstraints();
        Schema::create('yarn', function (Blueprint $table) {
            $table->bigIncrements('yarn_id');
            $table->integer('brand_id')->unsigned();
            $table->integer('yarn_name_id')->unsigned();
            $table->integer('put_up_id')->unsigned();
            $table->integer('yarn_weight_id')->unsigned();
            $table->text('notes');
            $table->boolean('handspun');
            $table->integer('fibre_id')->unsigned();
            $table->integer('metres_per_ball');
            $table->decimal('price_gbp');
            $table->integer('ball_weight');

            $table->foreign('brand_id')->references('brand_id')->on('brand');
            $table->foreign('yarn_name_id')->references('yarn_name_id')->on('yarn_name');
            $table->foreign('put_up_id')->references('put_up_id')->on('put_up');
            $table->foreign('yarn_weight_id')->references('yarn_weight_id')->on('yarn_weight');
            $table->foreign('fibre_id')->references('fibre_id')->on('fibre');
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
        Schema::dropIfExists('yarn');
    }
}
