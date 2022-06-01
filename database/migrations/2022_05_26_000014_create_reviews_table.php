<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('rating');
            $table->string('feedback');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('restrict');

            $table->foreign('course_id')->references('id')->on('courses')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
