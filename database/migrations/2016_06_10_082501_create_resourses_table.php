<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resourses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name', 30)->index();
            $table->text('FTE');
            $table->text('Mobil_Phone');
            $table->text('Аltern_phone_number');
            $table->text('City');
            $table->text('Coment');
            $table->text('Allocation');
            $table->text('Region');
            $table->date('Hire_Date');
            $table->text('Position');
            $table->text('OS');
            $table->text('Equipment');
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
        Schema::drop('resourses');
    }
}
