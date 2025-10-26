<?php

namespace Database\Seeders;

use App\Models\TagList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'News', 'is_trending' => 1,],
            ['name' => 'Health', 'is_trending' => 1,],
            ['name' => 'Politics', 'is_trending' => 1,],
            ['name' => 'Education', 'is_trending' => 1,],
            ['name' => 'Tag 1', 'is_trending' => 0,],
            ['name' => 'Tag 2', 'is_trending' => 0,],
            ['name' => 'Tag 3', 'is_trending' => 0,],
            ['name' => 'Tag 4', 'is_trending' => 0,],
        ];

        TagList::insert($data);
    }
}
