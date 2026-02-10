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
        Schema::create('practice_metadata', function (Blueprint $table) {
            $table->id();

            $table->foreignId('practice_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('metadata_definition_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('value')->nullable();

            $table->timestamps();

            $table->unique(
                ['practice_id', 'metadata_definition_id'],
                'practice_metadata_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_metadata');
    }
};
