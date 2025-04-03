<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proposal_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained('proposals')->onDelete('cascade');
            $table->foreignId('reviewed_by')->constrained('users');
            
            // Grading Parameters
            $table->boolean('is_5g_innovation')->default(false);
            $table->boolean('is_5g_beyond_contribution')->default(false);
            $table->text('use_case_definition')->nullable();
            $table->boolean('is_poc_ready')->default(false);
            $table->boolean('has_commercial_validation')->default(false);
            $table->text('ip_identification')->nullable();
            
            // Review Status
            $table->enum('status', ['accepted', 'needs_revision', 'rejected'])->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('revision_notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposal_reviews');
    }
}; 