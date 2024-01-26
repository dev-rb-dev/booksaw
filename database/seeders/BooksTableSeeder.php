<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('books')->insert([
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'genre' => 'Sample Genre',
            'price' => 19.99,
            'quantity_available' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Add more books as needed
    }
}
