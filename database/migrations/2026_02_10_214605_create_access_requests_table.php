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
        Schema::create('access_requests', function (Blueprint $table) {
            $table->id();

            $table->string('protocol_number')->nullable();
            $table->string('subject');

            // Richiedente
            $table->string('requester_name');
            $table->string('requester_fiscal_code', 16);
            $table->string('requester_email')->nullable();
            $table->enum('requester_type', ['citizen', 'professional', 'delegate']);

            // Stato
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'expired',
                'revoked',
            ])->default('pending');

            $table->timestamp('requested_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // Tecnico che la gestisce
            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();

            $table->index('status');
            $table->index('requester_fiscal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_requests');
    }
};
