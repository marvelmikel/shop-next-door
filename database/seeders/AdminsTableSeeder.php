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
            ['id' =>2, 'name' =>'John',
             'type'=>'vendor', 'vendor_id'=>1,
              'mobile'=>'09045693445','email'=>'vendor@demo.com',
               'password'=>'$2a$12$rQp5YUoJW2mWQvNCyDNHn..oXNRNJoetby5RDdYUh006CHa4hR7m2', 'image'=>'', 'status'=>0],
        ];

        Admin::insert($adminRecords);
    }
}
