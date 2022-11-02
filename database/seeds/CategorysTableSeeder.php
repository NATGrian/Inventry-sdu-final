<?php

use Illuminate\Database\Seeder;
use App\Models\Categorys_ingredients;
use App\Models\Categorys_packagings;
use App\Models\Categorys_products;

class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorys_ingredients::create([
            'name' => 'วัตถุดิบ',
            'description' => 'วัตถุดิบ'
        ]);

        Categorys_packagings::create([
            'name' => 'บรรจุภัณฑ์',
            'description' => 'บรรจุภัณฑ์'
        ]);

        Categorys_products::create([
            'name' => 'ผลิตภัณฑ์',
            'description' => 'ผลิตภัณฑ์'
        ]);
    }
}
