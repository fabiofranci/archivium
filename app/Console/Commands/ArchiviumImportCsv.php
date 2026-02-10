<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PracticeCsvImporter;
use Throwable;

class ArchiviumImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'archivium:import-csv
        {csv : Path al file CSV}
        {--archive-path= : Path base dell’archivio documentale}';

    /**
     * The console command description.
     */
    protected $description = 'Importa pratiche da CSV e collega i documenti su filesystem (read-only)';

    /**
     * Execute the console command.
     */
    public function handle(PracticeCsvImporter $importer): int
    {
        $csvPath = $this->argument('csv');
        $archivePath = $this->option('archive-path') ?? config('archivium.archive_path');

        // Verifica CSV
        if (!file_exists($csvPath)) {
            $this->error("CSV non trovato: {$csvPath}");
            return Command::FAILURE;
        }

        if (pathinfo($csvPath, PATHINFO_EXTENSION) !== 'csv') {
            $this->error('Il file fornito non è un CSV valido');
            return Command::FAILURE;
        }

        // Verifica archivio
        if (!$archivePath) {
            $this->error('Archive path non specificato (--archive-path o config)');
            return Command::FAILURE;
        }

        if (!is_dir($archivePath)) {
            $this->error("Archive path non valido o non accessibile: {$archivePath}");
            return Command::FAILURE;
        }

        $this->info('Import CSV in corso...');
        $this->line("CSV: {$csvPath}");
        $this->line("Archivio: {$archivePath}");

        try {
            $count = $importer->import($csvPath, $archivePath);
        } catch (Throwable $e) {
            $this->error('Errore durante l’import CSV');
            $this->line($e->getMessage());
            return Command::FAILURE;
        }

        $this->info("Import completato. Pratiche elaborate: {$count}");

        return Command::SUCCESS;
    }
}
