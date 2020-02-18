<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('logical_thinking', ['A', 'B', 'C']);
            $table->enum('skills', ['A', 'B', 'C']);
            $table->enum('attitudes', ['A', 'B', 'C']);
            $table->enum('period', ['First Evaluation', 'Midterm Evaluation', 'Final Evaluation']);
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('evaluations');
    }
}
