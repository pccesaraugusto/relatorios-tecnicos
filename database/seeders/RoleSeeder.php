<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela roles para evitar duplicidade
        DB::table('roles')->truncate();
        
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Acesso total ao sistema',
                'permissions' => json_encode([
                    'users' => ['create', 'read', 'update', 'delete'],
                    'reports' => ['create', 'read', 'update', 'delete', 'validate', 'archive'],
                    'settings' => ['read', 'update'],
                    'audit' => ['read']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'supervisor',
                'display_name' => 'Supervisor',
                'description' => 'Valida e supervisiona relatórios',
                'permissions' => json_encode([
                    'reports' => ['read', 'validate', 'reject'],
                    'audit' => ['read']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'tecnico',
                'display_name' => 'Técnico',
                'description' => 'Cria e envia relatórios',
                'permissions' => json_encode([
                    'reports' => ['create', 'read', 'update']
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}