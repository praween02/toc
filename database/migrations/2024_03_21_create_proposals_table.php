<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->date('expected_completion_date');
            $table->text('expected_output');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('institute_id')->constrained('institutes');
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'rejected'])->default('draft');
            $table->timestamps();
        });

        Schema::create('proposal_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained('proposals')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->string('role');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposal_team_members');
        Schema::dropIfExists('proposals');
    }
}; 