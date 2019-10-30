<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nomer');
            $table->text('name');
            $table->text('address');
            $table->text('lat');
            $table->text('lon');
            $table->text('sity');
            $table->text('oblast');
            $table->text('partner');
            $table->char('styleplacemark', 30)->default('twirl#blueStretchyIcon');
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
        Schema::drop('address');
    }
}
