<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['id' => 4, 'title' => 'Alimentos'],
            ['id' => 5, 'title' => 'Informática'],
            ['id' => 2, 'title' => 'Eletrodomésticos'],
            ['id' => 3, 'title' => 'Celulares'],
        ];

        DB::table('category')->insert($category);
    }
}
