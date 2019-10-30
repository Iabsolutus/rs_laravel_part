<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssAdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_adress', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ФИО');
            $table->text('ФИО (рус)');
            $table->text('Актуальный адрес');
            $table->text('Филиал');
            $table->text('lat');
            $table->text('lon');
            $table->char('styleplacemark', 30)->default('twirl#houselcon');
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
        Schema::drop('rss_adress');
    }
}
