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
        Schema::create('equipment_specifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vendor_id')->comment('Vendor Id');
            $table->unsignedBigInteger('equipment_id')->comment('Equipment Id');

            $table->text('specification')->comment('Specification');
            $table->string('image', 96)->nullable()->comment('Image');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('users');
            $table->foreign('equipment_id')->references('id')->on('equipments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_specifications', function (Blueprint $table) {
            $table->dropForeign(['vendor_id', 'equipment_id']);
        });
        
        Schema::dropIfExists('equipment_specifications');
    }
};
