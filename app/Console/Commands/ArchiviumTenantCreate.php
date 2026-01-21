<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;

class ArchiviumTenantCreate extends Command
{
    protected $signature = 'archivium:tenant:create {slug}';
    protected $description = 'Crea un tenant Archivium (ente)';

    public function handle(): int
    {
        $slug = $this->argument('slug');
        $baseDomain = config('app.tenancy_base_domain');

        // Crea tenant
        $tenant = Tenant::create([
            'id' => $slug,
        ]);

        // Associa dominio
        Domain::create([
            'domain'    => "{$slug}.{$baseDomain}",
            'tenant_id' => $tenant->id,
        ]);

        $this->info('Tenant creato correttamente');
        $this->line("Dominio: http://{$slug}.{$baseDomain}:8000");

        return self::SUCCESS;
    }
}
