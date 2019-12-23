<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionResultPivotTable extends Migration
{
    public function up()
    {
        Schema::create('question_result', function (Blueprint $table) {
            $table->unsignedInteger('result_id');

            $table->foreign('result_id', 'result_id_fk_773767')->references('id')->on('results')->onDelete('cascade');

            $table->unsignedInteger('question_id');

            $table->foreign('question_id', 'question_id_fk_773767')->references('id')->on('questions')->onDelete('cascade');

            $table->unsignedInteger('option_id');

            $table->foreign('option_id', 'option_id_fk_773767')->references('id')->on('options')->onDelete('cascade');

            $table->integer('points')->default(0);
        });
    }
}
