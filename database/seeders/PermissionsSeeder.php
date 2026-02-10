<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar as SpatiePermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permessi
        app(SpatiePermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'practices.view',
            'documents.view',
            'documents.download',
            'access_requests.manage',
            'access_requests.view',
            'access_documents.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $enteAdmin = Role::firstOrCreate(['name' => 'ente_admin']);
        $istruttore = Role::firstOrCreate(['name' => 'istruttore']);
        $accessoAttiManager = Role::firstOrCreate(['name' => 'accesso_atti_manager']);
        $accessoAttiEsterno = Role::firstOrCreate(['name' => 'accesso_atti_esterno']);

        $enteAdmin->syncPermissions($permissions);

        $istruttore->syncPermissions([
            'practices.view',
            'documents.view',
            'documents.download',
        ]);

        $accessoAttiManager->syncPermissions([
            'practices.view',
            'documents.view',
            'documents.download',
            'access_requests.manage',
        ]);

        $accessoAttiEsterno->syncPermissions([
            'access_requests.view',
            'access_documents.view',
        ]);
    }
}
