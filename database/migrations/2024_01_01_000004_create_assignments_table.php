<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id('assign_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('worker_id');
            $table->date('assigned_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('worker_id')->references('worker_id')->on('workers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
