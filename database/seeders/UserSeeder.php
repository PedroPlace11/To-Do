<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Criar utilizador padrão para desenvolvimento
        User::firstOrCreate(
            ['email' => 'dev@todo.test'],
            [
                'name' => 'Dev User',
                'password' => bcrypt('password'),
            ]
        );
    }
}
