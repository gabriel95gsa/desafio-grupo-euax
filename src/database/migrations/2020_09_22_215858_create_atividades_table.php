<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projeto_id')
                ->nullable(false);
            $table->string('nome')
                ->nullable(false);
            $table->date('data_inicio')
                ->nullable(false);
            $table->date('data_fim')
                ->nullable(false);
            $table->boolean('finalizada')
                ->nullable(true)
                ->default(0);
            $table->timestamps();
            $table->foreign('projeto_id')
                ->references('id')
                ->on('projetos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
}
