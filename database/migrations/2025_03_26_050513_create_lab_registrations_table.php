<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_registrations', function (Blueprint $table) {
            $table->id();
            
            // Applicant Details
            $table->string('applicant_category')->nullable();
            $table->string('subcategory')->nullable();
            
            // Basic Details
            $table->string('person_name');
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->string('institute_company');
            $table->text('address');
            
            // Contact Details
            $table->string('mobile_no');
            $table->string('email_id')->unique();
            
            // Additional field for reason
            $table->longText('reason')->nullable();
            
            // Status and timestamps
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            
            // Foreign key
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_registrations');
    }
}