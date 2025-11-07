<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate(); // limpa dados da tabela

        User::create([
            'role_id' => 1, // ajuste conforme sua tabela
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
            'cpf' => '00000000000', // se aplicável
            'phone' => '123456789',
        ]);
    }
}
