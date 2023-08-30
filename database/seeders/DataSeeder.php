<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Manager;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =[
			[
        		'name' => 'Arsenio',
        		'username' => 'Kasir1',
        		'password' => bcrypt('1111'),
			],
			[
        		'name' => 'Kasih',
        		'username' => 'kasir2',
        		'password' => bcrypt('2222'),
			],
        ];
        foreach ($users as $key1 => $user) {
        	User::create($user);
        }

        //manager
    	$managers =[
			[
        		'name' => 'galang',
        		'username' => 'Manager1',
        		'password' => bcrypt('1111'),
			],
			[
        		'name' => 'fitroh',
        		'username' => 'Manager2',
        		'password' => bcrypt('2222'),
			],
        ];
        foreach ($managers as $key2 => $manager) {
        	Manager::create($manager);
        }
    }
}
