<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsinworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsinworks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('№')->nullable();
            $table->string('ФИО', 30)->index();
            $table->text('Город');
            $table->text('Аккаунт');
            $table->text('Филиал');
            $table->text('Номер');
            $table->text('Сервис');
            $table->text('Номер ДС');
            $table->dateTime('Начало ДС');
            $table->dateTime('Окончание ДС');
            $table->text('OLA');
            $table->text('SLA');
            $table->text('Статус ДС');
            $table->text('Статус Об');
            $table->text('Год начала');
            $table->text('Месяц начала');
            $table->text('День начала');
            $table->text('Год окончания');
            $table->text('Месяц окончания');
            $table->text('День окончания');
            $table->text('FTE');
            $table->text('Полный_номер_ДС');
            $table->dateTime('ЦВЗ');
            $table->text('Заголовок');
            $table->text('Описание');
            $table->dateTime('Дата создания ДС');
            $table->dateTime('Время выполнения ДС');
            $table->dateTime('ЦВЗ Запроса');
            $table->text('Просрочка');
            $table->dateTime('Длит ДС');
            $table->dateTime('Длит ДС (Часы)');
            $table->dateTime('Календ Длит ДС');
            $table->dateTime('Календ Длит ДС (Часы)');
            $table->dateTime('Время в пути');
            $table->dateTime('Время в пути (Часы)');
            $table->text('Banch');
            $table->text('Комментарий');
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
        Schema::drop('dsinworks');
    }
}
