<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tic_system_manual', function (Blueprint $table) {
            $table->increments('id');
            $table->id('equipment_id')->default(0)->comment('This id Belong to ticl_equipment table');
            $table->var('document_title')->default(NULL);
            $table->text('document_description')->default(NULL);
            $table->var('document_file')->default(NULL);
            $table->set('status',['0','1'])->default(0);
            $table->id('created_by')->default(0)->comment('This id Belong to ticl_users table');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tic_system_manual');
    }
};
