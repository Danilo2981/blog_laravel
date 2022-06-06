<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Danilo',
            'email' => 'danilo@example.com',
        ]);

        User::factory()->create([
            'name' => 'Soporte',
            'email' => 'soporte@example.com',
        ]);

        $this->call(CategorySeeder::class);

        Article::factory(20)->create();
    }
}
