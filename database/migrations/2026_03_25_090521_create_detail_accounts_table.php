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
        Schema::create('detail_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('code')->unique();
            $table->foreignId('type_id')
                ->constrained('detail_account_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('national_id')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_accounts');
    }
};
