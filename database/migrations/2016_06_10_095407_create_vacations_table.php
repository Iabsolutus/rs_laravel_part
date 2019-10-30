<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FIO', 30);
            $table->date('vacation_with');
            $table->date('vacation_to');
            $table->string('comment', 200)->default('Отпуск');
            $table->string('active', 2);
            $table->timestamps();

            $table->index(['FIO', 'vacation_with', 'vacation_to']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vacations');
    }
}
