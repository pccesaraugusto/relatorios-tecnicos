<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultilingualSettingSeeder extends Seeder
{
    public function run()
    {
        // Exemplo de configurações multilíngues - armazenar JSON para traduções
        DB::table('settings')->insert([
            [
                'key' => 'welcome_message',
                'value' => json_encode([
                    'pt_BR' => 'Bem-vindo ao sistema!',
                    'en_US' => 'Welcome to the system!',
                ]),
                'type' => 'json',
                'group' => 'general',
                'description' => 'Mensagem de boas-vindas multilíngue',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'date_format',
                'value' => json_encode([
                    'pt_BR' => 'd/m/Y',
                    'en_US' => 'm/d/Y',
                ]),
                'type' => 'json',
                'group' => 'general',
                'description' => 'Formato de data multilíngue',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}