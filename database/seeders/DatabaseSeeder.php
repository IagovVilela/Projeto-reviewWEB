<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            // DemoDataSeeder::class, // Descomentar para dados de teste
            // CompleteDataSeeder::class, // Descomentar para dados completos
            // RealDataSeeder::class, // Descomentar para dados reais exportados
        ]);
    }
}




