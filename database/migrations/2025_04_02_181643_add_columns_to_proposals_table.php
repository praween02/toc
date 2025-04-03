<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run this migration using below <command>
    // php artisan migrate --path=/database/migrations/2025_04_02_181643_add_columns_to_proposals_table.php

    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            if (!Schema::hasColumn('proposals', 'stack_holder')) {
                $table->string('stack_holder', 50)->nullable();
            }
            if (!Schema::hasColumn('proposals', 'socio_economic_vertical')) {
                $table->string('socio_economic_vertical', 50)->nullable()->after('stack_holder');
            }
            if (!Schema::hasColumn('proposals', 'proposal_brief')) {
                $table->text('proposal_brief')->nullable()->after('socio_economic_vertical');
            }
            if (!Schema::hasColumn('proposals', 'days_required')) {
                $table->string('days_required', 100)->nullable()->after('proposal_brief');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            if (Schema::hasColumn('proposals', 'stack_holder')) {
                $table->dropColumn('stack_holder');
            }
            if (Schema::hasColumn('proposals', 'socio_economic_vertical')) {
                $table->dropColumn('socio_economic_vertical');
            }
            if (Schema::hasColumn('proposals', 'proposal_brief')) {
                $table->dropColumn('proposal_brief');
            }
            if (Schema::hasColumn('proposals', 'days_required')) {
                $table->dropColumn('days_required');
            }
        });
    }
};
