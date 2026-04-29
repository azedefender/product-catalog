<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём одного пользователя
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);

        // Создаём категории
        $categories = ['Электроника', 'Одежда', 'Книги', 'Дом'];
        foreach ($categories as $cat) {
            Category::factory()->create(['name' => $cat]);
        }

        // Создаём 30 товаров
        Product::factory(30)->create();
    }
}