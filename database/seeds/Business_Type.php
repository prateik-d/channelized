<?php

use Illuminate\Database\Seeder;
use App\Businesstype;

class Business_Type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Businesstype::truncate();
        
        Businesstype::create([
            'name' => 'Reseller'
        ]);
        Businesstype::create([
            'name' => 'MSP (Managed Services Provider)'
        ]);
        Businesstype::create([
            'name' => 'ISV (Independent Software Vendor)'
        ]);
    }
}
