<?php

// database/migrations/xxxx_xx_xx_create_lab_registrations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('lab_registrations', function (Blueprint $table) {
            $table->id();

            // Applicant Category Section
            $table->enum('applicant_category', ['Academia', 'Industry', 'R&D'])->nullable();
            $table->string('subcategory')->nullable();

            // Basic Details Section
            $table->string('person_name');
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->string('institute_input');
            $table->string('pan_number')->nullable();
            $table->text('address');
            $table->text('reason_to_join');

            // 5G Use Case Lab Section
            $table->unsignedBigInteger('zone_id'); // Foreign key to zones table
            $table->string('institute_selection');

            // Authorization Details
            $table->string('mobile_no');
            $table->boolean('mobile_verified')->default(false);
            $table->string('email_id')->unique();
            $table->string('password');
            $table->boolean('email_verified')->default(false);

            // Status and timestamps
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            // Foreign keys
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('restrict');

            // Indexes
            $table->index('applicant_category');
            $table->index('zone_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lab_registrations');
    }
}
