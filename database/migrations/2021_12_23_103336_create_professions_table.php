<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            // We are not creating new migration for changing field type, timestamp is unknown type
            $table->date('open_date');
            $table->date('close_date');
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
        Schema::dropIfExists('professions');
    }
}
