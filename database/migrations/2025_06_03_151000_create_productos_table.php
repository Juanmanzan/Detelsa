<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('ingredientes');
            $table->text('modo_de_uso');
            $table->decimal('precio', 8, 2);
            $table->unsignedBigInteger('categoria_id')->nullable();;
            $table->boolean('promocion')->default(false);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');

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
};
