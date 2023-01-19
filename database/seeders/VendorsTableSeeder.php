<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id' => 1, 'name' =>'John', 'address' =>'CP-112', 'city'=>'London',
             'state' =>'london', 'country' =>'united kingdom', 'pincode'=>'000340',
              'mobile'=>'09045693445', 'email' =>'vendor@demo.com', 'status'=>0],

        ];
        Vendor::insert($vendorRecords);
    }
}
