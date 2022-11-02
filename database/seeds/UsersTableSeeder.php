<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Models\Relevants;
use App\Models\Storages;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            User::create([
                'role_id' => 1,
        		'firstname' => 'แอดมิน',
                'lastname' => 'administrator',
                'phone' => rand(0000000000,9999999999),
                'image' => 'avatar.png',
        		'email' => 'administrator@gmail.com',
        		'password' => bcrypt('password'),
        		'api_token' => NULL
        	]);
        
        	Relevants::create([
                'GID' => 1,
        		'firstname' => 'แอดมิน',
                'lastname' => 'administrator',
                'image' => 'avatar.png'
        	]);

            Storages::create([
        		'name' => 'คลังเก็บวัตถุดิบ',
                'description' => 'ที่เก็บวัตถุดิบ'
        	]);
            Storages::create([
        		'name' => 'คลังเก็บผลิตภัณฑ์',
                'description' => 'ที่เก็บผลิตภัณฑ์'
        	]);
            Storages::create([
        		'name' => 'คลังเก็บบรรจุภัณฑ์',
                'description' => 'ที่เก็บบรรจุภัณฑ์'
        	]);
        
    }
}
