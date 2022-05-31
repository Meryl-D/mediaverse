<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'secretariat',
            ],
            [
                'name' => 'enseignant',
            ],
            [
                'name' => 'etudiant',
            ],
        ];

        DB::table('roles')->insert($data);
    }
}
