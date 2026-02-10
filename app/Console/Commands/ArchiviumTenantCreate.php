<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;

class ArchiviumTenantCreate extends Command
{
    protected $signature = 'archivium:tenant:create {slug}';
    protected $description = 'Crea un tenant Archivium (ente)';

    public function handle(): int
    {
        $slug = $this->argument('slug');
        $baseDomain = config('tenancy.central_domains')[2] ?? config('app.tenancy_base_domain'); // fallback
        $baseDomain = config('app.tenancy_base_domain') ?? env('TENANCY_BASE_DOMAIN');

        $tenant = Tenant::create([
            'id' => $slug,
        ]);

        $tenant->domains()->create([
            'domain' => "{$slug}." . $baseDomain,
        ]);

        $this->info("Tenant creato: {$slug}");
        $this->line("Dominio: http://{$slug}.{$baseDomain}:8000/admin");

        return self::SUCCESS;
    }
}
