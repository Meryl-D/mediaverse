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
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('credit');
            $table->string('name');
            $table->integer('semester_id')->unsigned();

            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->integer('sector_id')->unsigned();

            $table->foreign('sector_id')->references('id')->on('sectors')
                ->onDelete('restrict')
                ->onUpdate('restrict');
                
            $table->string('acronym');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
};
