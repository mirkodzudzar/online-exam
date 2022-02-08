<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_profession', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('attempted');
            $table->dropColumn('correct');
            $table->dropColumn('wrong');
            $table->dropColumn('percentage');
        });

        Schema::create('candidate_exam', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id');
            $table->foreign('candidate_id')
                  ->references('id')
                  ->on('candidates');

            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams');

            $table->integer('total');
            $table->integer('attempted');
            $table->integer('correct');
            $table->integer('wrong');
            $table->decimal('percentage', 5, 2);
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
        Schema::dropIfExists('candidate_exam');

        Schema::table('candidate_profession', function (Blueprint $table) {
            $table->integer('total')->default(0);
            $table->integer('attempted')->default(0);
            $table->integer('correct')->default(0);
            $table->integer('wrong')->default(0);
            $table->decimal('percentage', 5, 2);
        });
    }
}
