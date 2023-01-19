<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetail;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>1, 'vendor_id'=>'1', 'account_holder_name'=>'john Doe',
             'bank_name'=>'Revolut', 'account_number'=>'0242918896',
              'bank_ifsc_code'=>'58585'],

        ];

        VendorsBankDetail::insert( $vendorRecords);
    }
}
