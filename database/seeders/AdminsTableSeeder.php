<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id' =>1, 'name' =>'Super Admin',
             'type'=>'superadmin', 'vendor_id'=>0,
              'mobile'=>'9800000000','email'=>'admin@demo.com',
               'password'=>'$2a$12$mErQeTgYbOwwIxF7x2hFCeG6rLVJjQ1P34uDdnf0DHkA47qNzQKCS', 'image'=>'', 'status'=>1],


        ];

        Admin::insert($adminRecords);
    }
}
