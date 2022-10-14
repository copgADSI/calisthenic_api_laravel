<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routines', function (Blueprint $table) {
            $table->foreign(['difficulty_id'])->references(['id'])->on('difficulties')->onDelete('CASCADE');
            $table->foreign(['muscle_group_id'])->references(['id'])->on('muscle_groups')->onDelete('CASCADE');
            $table->foreign(['excercise_id'])->references(['id'])->on('excercises')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routines', function (Blueprint $table) {
            $table->dropForeign('routines_difficulty_id_foreign');
            $table->dropForeign('routines_muscle_group_id_foreign');
            $table->dropForeign('routines_excercise_id_foreign');
            $table->dropForeign('routines_user_id_foreign');
        });
    }
}
