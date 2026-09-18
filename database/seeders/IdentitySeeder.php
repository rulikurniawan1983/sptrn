<?php

namespace Database\Seeders;

use App\Models\Identity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => 1,
                'kode' => 'title',
                'name' => 'Title',
                'type' => 'Text',
                'value' => 'SMART ASN',
                'category_identity_id' => 2,
                'type_file' => NULL,
                'sequence' => 1
            ],
            [
                'id' => 3,
                'kode' => 'keyword',
                'name' => 'Keyword',
                'type' => 'Textarea',
                'value' => NULL,
                'category_identity_id' => 2,
                'type_file' => NULL,
                'sequence' => 3
            ],
            [
                'id' => 4,
                'kode' => 'logo',
                'name' => 'Logo',
                'type' => 'File',
                'value' => '20240322060448-Screenshot_2024-03-22_at_06.01.16-removebg-preview.png',
                'category_identity_id' => 2,
                'type_file' => 'png',
                'sequence' => 4
            ],
            [
                'id' => 5,
                'kode' => 'description',
                'name' => 'Description',
                'type' => 'Textarea',
                'value' => 'SMART ASN Panel',
                'category_identity_id' => 2,
                'type_file' => NULL,
                'sequence' => 2
            ],
            [
                'id' => 6,
                'kode' => 'ico',
                'name' => 'Ico',
                'type' => 'File',
                'value' => '20240322060448-Screenshot_2024-03-22_at_06.01.16-removebg-preview.png',
                'category_identity_id' => 2,
                'type_file' => 'png',
                'sequence' => 5
            ],
            [
                'id' => 7,
                'kode' => 'copyright',
                'name' => 'Copyright',
                'type' => 'Text',
                'value' => '© 2024 SMART ASN',
                'category_identity_id' => 3,
                'type_file' => NULL,
                'sequence' => 1
            ],
            [
                'id' => 8,
                'kode' => 'iklan-setiap-paragraft',
                'name' => 'Iklan Setiap Berapa Paragraf akan dimunculkan',
                'type' => 'Text',
                'value' => '2',
                'category_identity_id' => 4,
                'type_file' => NULL,
                'sequence' => 2
            ],
        ];
        foreach ($listData as $data) {
            Identity::create($data);
        }
        $this->command->info('Identity table seeded!');
    }
}
