<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTrophiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_trophies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned()->nullable();
            $table->foreign('player_id')->references('id')->on('players');
            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->integer('tournament_id')->unsigned()->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->integer('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_trophies');
    }
}
