<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre",255);
            $table->string("slug");
            $table->text("descripcion");
            $table->string("extracto");
            $table->decimal("precio");
            $table->string("imagen",300);
            $table->boolean("visible");
            $table->integer("categoria_id")->unsigned();
            $table->foreign("categoria_id")->references("id")->on("categorias")->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
