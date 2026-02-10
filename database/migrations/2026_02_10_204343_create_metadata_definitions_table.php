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
        Schema::create('metadata_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();   // es. protocollo
            $table->string('label');             // es. Numero protocollo
            $table->string('type')->default('string'); // string, number, date
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metadata_definitions');
    }
};
