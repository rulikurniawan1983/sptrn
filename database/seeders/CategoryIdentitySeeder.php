<?php

namespace Database\Seeders;

use App\Models\CategoryIdentity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryIdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => 2,
                'name' => 'Meta Admin Panel',
                'file' => ''==null,
                'description' => 'Title, Description, Keyword',
                'sequence' => 1
            ], 
            [
                'id' => 3,
                'name' => 'Footer',
                'file' => null,
                'description' => NULL,
                'sequence' => 2
            ],
            [
                'id' => 4,
                'name' => 'Setting Post Management',
                'file' => null,
                'description' => NULL,
                'sequence' => 3
            ]
        ];
        foreach ($listData as $data) {
            CategoryIdentity::create($data);
        }
        $this->command->info('Category Identity table seeded!');
    }
}
