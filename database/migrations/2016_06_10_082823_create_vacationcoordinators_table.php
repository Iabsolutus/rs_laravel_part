<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationcoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacationcoordinators', function (Blueprint $table) {
            $table->increments('id');
            $table->text('Name');
            $table->text('January');
            $table->text('February');
            $table->text('March');
            $table->text('April');
            $table->text('May');
            $table->text('June');
            $table->text('July');
            $table->text('August');
            $table->text('September');
            $table->text('October');
            $table->text('November');
            $table->text('December');
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
        Schema::drop('vacationcoordinators');
    }
}
