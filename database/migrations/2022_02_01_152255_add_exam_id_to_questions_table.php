<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamIdToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['profession_id']);
            $table->dropColumn('profession_id');

            $table->unsignedBigInteger('exam_id')
                  ->after('id')
                  ->nullable();
            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');

            // Only if table 'professions' exists, add field and foreign key.
            if (Schema::hasTable('professions')) {
                $table->unsignedBigInteger('profession_id');
                $table->foreign('profession_id')
                      ->references('id')
                      ->on('professions')
                      ->onDelete('cascade');
            }
        });
    }
}
