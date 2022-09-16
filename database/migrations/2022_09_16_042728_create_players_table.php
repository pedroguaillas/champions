<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('champion_id');
            $table->unsignedBigInteger('team_id');
            $table->string('cedula', 10)->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('photo', 100)->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('champion_id')->references('id')->on('champions');
            $table->unique(['cedula', 'champion_id'], 'player_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
