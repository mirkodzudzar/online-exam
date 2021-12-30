<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCandidateProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_profession', function (Blueprint $table) {
            $table->integer('total')->default(0);
            $table->integer('attempted')->default(0);
            $table->integer('correct')->default(0);
            $table->integer('wrong')->default(0);
            $table->string('status')->default('applied');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_profession', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('attempted');
            $table->dropColumn('correct');
            $table->dropColumn('wrong');
            $table->dropColumn('status');
        });
    }
}
