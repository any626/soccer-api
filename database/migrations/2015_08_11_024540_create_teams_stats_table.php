<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_stats', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('played')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('loses')->default(0);
            $table->integer('draws')->default(0);
            $table->integer('goals_for')->default(0);
            $table->integer('goals_against')->default(0);
            $table->integer('points')->default(0);
            $table->integer('last_game_day')->default(0);
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
        Schema::drop('teams_stats');
    }
}