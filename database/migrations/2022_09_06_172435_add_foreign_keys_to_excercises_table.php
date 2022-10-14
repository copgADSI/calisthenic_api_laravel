<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExcercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('excercises', function (Blueprint $table) {
            $table->foreign(['muscle_groups_id'])->references(['id'])->on('muscle_groups');
            $table->foreign(['user_id'])->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('excercises', function (Blueprint $table) {
            $table->dropForeign('excercises_muscle_groups_id_foreign');
            $table->dropForeign('excercises_user_id_foreign');
        });
    }
}
