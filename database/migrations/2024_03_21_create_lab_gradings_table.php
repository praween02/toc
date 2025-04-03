<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lab_gradings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained('institutes')->onDelete('cascade');
            $table->boolean('innovation_project_check')->default(false);
            $table->boolean('beyond_contribution')->default(false);
            $table->text('use_case_definition')->nullable();
            $table->boolean('poc_readiness_check')->default(false);
            $table->boolean('commercial_product_validation')->default(false);
            $table->text('ip_identification')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lab_gradings');
    }
}; 