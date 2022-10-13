<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => Str::uuid()->toString(),'name' => 'Gynecologist'],
            ['id' => Str::uuid()->toString(),'name' => 'Dentist'],
            ['id' => Str::uuid()->toString(),'name' => 'Medicine Expert'],

        ]);
    }
}
