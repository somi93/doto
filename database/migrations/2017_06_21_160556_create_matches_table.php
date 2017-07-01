<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team1')->unsigned();
            $table->foreign('team1')->references('id')->on('teams');
            $table->integer('team2')->unsigned();
            $table->foreign('team2')->references('id')->on('teams');
            $table->integer('tournament_id')->unsigned();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->integer('start_time');
            $table->integer('team1score')->nullable();
            $table->integer('team2score')->nullable();
            $table->integer('team1points')->nullable();
            $table->integer('team2points')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
