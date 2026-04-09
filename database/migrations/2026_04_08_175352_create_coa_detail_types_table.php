<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // note: The table name limit in MySQL is 64 characters. then we use coa_detail_types instead of chart_of_account_detail_account_type
        Schema::create('coa_detail_types', function (Blueprint $table) {
            $table->id();

            // account_id for chart_of_account_id
            $table->foreignId('account_id')
                ->constrained('chart_of_accounts')
                ->cascadeOnDelete();

            // type_id for detail_type_id
            $table->foreignId('type_id')
                ->constrained('detail_account_types')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'account_id',
                'type_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coa_detail_types');
    }
};
