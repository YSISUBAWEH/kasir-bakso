<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kate =[
			[
        		'nama' => 'Makanan',
			],
			[
        		'nama' => 'Minuman',
			],
        ];
        foreach ($kate as $key1 => $Kategori) {
        	Kategori::create($Kategori);
        }
    }
}
