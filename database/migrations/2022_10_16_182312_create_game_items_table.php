<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('game_id');
            $table->set('entered_in', ['inicio', 'ajustar', 'cambio']);
            $table->unsignedBigInteger('change_player_id')->nullable();
            $table->integer('goals')->default(0);
            $table->set('santion', ['amarilla', 'roja'])->nullable();
            $table->boolean('santion_state')->default(false);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('change_player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_items');
    }
}
