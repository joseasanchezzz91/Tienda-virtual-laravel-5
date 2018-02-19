<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_items', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('precio');
            $table->integer('cantidad');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')
                ->on('productos')->onDelete('cascade');
            $table->integer('orden_id')->unsigned();
            $table->foreign('orden_id')->references('id')
                ->on('ordens')->onDelete('cascade');
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
        Schema::dropIfExists('orden_items');
    }
}
