<?php

namespace Database\Seeders;
use App\Models\VendorsBusinessDetail;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBusinessDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>1, 'vendor_id'=>'1', 'shop_name'=>'John Electronics Store',
             'shop_address'=>'19 grove avenue', 'shop_city'=>'birmingham',
              'shop_state'=>'west midland', 'shop_country'=>'united kingdom', 'shop_pincode'=>'b219ex',
              'shop_mobile'=>'09045693445', 'shop_website'=>'demo.com', 'shop_email'=>'vendor@demo.com',
              'address_proof'=>'Passport', 'address_proof_image'=>'test.jpg', 'business_license_number'=>'23384948383'],

        ];

        VendorsBusinessDetail::insert( $vendorRecords);
        //
    }
}
