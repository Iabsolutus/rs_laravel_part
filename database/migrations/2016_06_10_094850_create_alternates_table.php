<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternates', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Name');
            $table->text('ВТБ');
            $table->text('ВТБ_АТМ');
            $table->text('ВТБ_Печатка');
            $table->text('IBM');
            $table->text('DOW');
            $table->text('USB');
            $table->text('UkrGaz');
            $table->text('BAT');
            $table->text('Kredo');
            $table->text('PUMB');
            $table->text('KC');
            $table->text('INPAS');
            $table->text('ITO');
            $table->text('TEST');
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
        Schema::drop('alternates');
    }
}
