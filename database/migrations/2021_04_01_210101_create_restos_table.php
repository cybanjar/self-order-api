<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable();
            $table->longText('img')->nullable();
            $table->enum('category', ['food', 'beverage', 'dessert']); // food, beverage, dessert
            $table->string('icons')->nullable();
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('total')->nullable();
            $table->integer('qty')->nullable();
            $table->text('note')->nullable();
            $table->boolean('popular')->default(false);
            $table->integer('table')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('service')->nullable();
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
        Schema::dropIfExists('restos');
    }
}
