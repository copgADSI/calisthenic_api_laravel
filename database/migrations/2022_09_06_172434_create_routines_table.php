<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resps_number');
            $table->integer('sets_number');
            $table->string('breack');
            $table->unsignedBigInteger('excercise_id')->index('routines_excercise_id_foreign');
            $table->unsignedBigInteger('muscle_group_id')->index('routines_muscle_group_id_foreign');
            $table->unsignedBigInteger('difficulty_id')->index('routines_difficulty_id_foreign');
            $table->unsignedBigInteger('user_id')->nullable()->index('routines_user_id_foreign');
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
        Schema::dropIfExists('routines');
    }
}
