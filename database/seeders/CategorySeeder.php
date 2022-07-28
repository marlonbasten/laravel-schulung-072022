<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CategorySeeder extends Seeder
{
    private array $categories = [
        'Allgemein',
        'Produkte',
        'Support',
    ];

    public function run()
    {
        foreach ($this->categories as $category) {
            if (Category::where('name', $category)->first()) {
                continue;
            }
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
