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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_year_id');
            $table->string('document_number', 10)->unique();
            $table->date('entry_date');
            $table->string('description', 255)->nullable();
            $table->unsignedInteger('created_by')->default(1); // replace with user_id after RBAC system.
            $table->unsignedTinyInteger('status')->default(0); // 0 = initial, 1 = temporary, 2 = final/approved
            $table->unsignedBigInteger('total_debit')->default(0);
            $table->unsignedBigInteger('total_credit')->default(0);
            $table->timestamps();

            $table->foreign('fiscal_year_id')
                ->references('id')
                ->on('fiscal_years')
                ->restrictOnDelete();
                
            $table->index(['fiscal_year_id', 'entry_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
