<?php

use Illuminate\Database\Seeder;
use App\Usertype;
use App\Models\Relevant_groups;


class UserstypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usertype::create([
            'role' => 'ผู้ปฎิบัติงาน',
        ]);

        Relevant_groups::create([
            'role' => 'ผู้เบิก',
        ]);
    }
}
