<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->id();

            // Identificativo proveniente dal CSV/gestionale sorgente
            $table->string('external_id')->nullable()->index();

            // Tipo pratica (se utile per filtri, eventuale enum in futuro)
            $table->string('practice_type')->nullable();

            // Stato interno (open/closed/archived ecc.)
            $table->string('status')->default('open');

            $table->timestamp('opened_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            $table->timestamps();
        });

        // Se vuoi unicità per external_id:
        // NB: se external_id può essere null o non garantito univoco dal sorgente, NON metterla.
        // Schema::table('practices', fn (Blueprint $t) => $t->unique('external_id'));
    }

    public function down(): void
    {
        Schema::dropIfExists('practices');
    }
};
