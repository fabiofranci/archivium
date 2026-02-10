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
        Schema::create('access_request_practices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('access_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('practice_id')
                ->constrained('practices')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['access_request_id', 'practice_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_request_practices');
    }
};
