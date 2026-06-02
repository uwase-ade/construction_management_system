<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity_used', 12, 2)->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
            $table->foreign('material_id')->references('material_id')->on('materials')->onDelete('cascade');
            $table->unique(['project_id', 'material_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_material');
    }
};
