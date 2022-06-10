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
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Soporte',
            'email' => 'soporte@example.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->call(CategorySeeder::class);

        Article::factory(20)->create();
    }
}
