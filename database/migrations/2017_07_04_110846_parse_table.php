<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParseTable extends Migration
{
    /**
     * Run the migrations.
     * создаем автоинкрементную колонку id
     * создаем колонку title тип строка
     * создаем колонку url тип строка
     * создаем колонку date тип дата+время
     * @return void
     */
    public function up()
    {
        Schema::create('parse_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url');
            $table->dateTime('date');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('parse_table');
    }
}
