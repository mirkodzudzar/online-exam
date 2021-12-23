<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_job', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidate_id')->index();
            $table->foreign('candidate_id')
                  ->references('id')
                  ->on('candidates')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('job_id')->index();
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('candidate_job');
    }
}
