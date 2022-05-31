<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
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
                    'first_name' => 'David',
                    'last_name' => 'Schenkel',
                    'email' => 'david.schenkel@heig-vd.ch',
                    'password' => Hash::make('david'),
                    'picture' => '',
                    'sector_id' => 5,
                    'role_id' => 3,
                ],
                [
                    'first_name' => 'Nicolas',
                    'last_name' => 'Chabloz',
                    'email' => 'nicolas.chabloz@heig-vd.ch',
                    'password' => Hash::make('nicolas'),
                    'picture' => '',
                    'sector_id' => 5,
                    'role_id' => 2,
                ],
                [
                    'first_name' => 'Daniela',
                    'last_name' => 'Oberlojer',
                    'email' => 'daniela.oberlojer@heig-vd.ch',
                    'password' => Hash::make('daniela'),
                    'picture' => '',
                    'sector_id' => 5,
                    'role_id' => 1,
                ],
                
        
            ];

            DB::table('users')->insert($data);
        
    }
}
