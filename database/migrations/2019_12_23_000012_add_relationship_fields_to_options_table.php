<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOptionsTable extends Migration
{
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->unsignedInteger('question_id');

            $table->foreign('question_id', 'question_fk_773758')->references('id')->on('questions');
        });
    }
}
