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
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('socio_economic_vertical')->nullable()->after('title');
            $table->string('stock_holder')->nullable()->after('institute_id');
            $table->text('proposal_brief')->nullable()->after('description');
            $table->integer('days_required')->nullable()->after('expected_completion_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'socio_economic_vertical',
                'stock_holder',
                'proposal_brief',
                'days_required'
            ]);
        });
    }
};
