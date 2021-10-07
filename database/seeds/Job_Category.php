<?php

use Illuminate\Database\Seeder;
use App\Jobcategory;
use App\Role;

class Job_Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobcategory::truncate();
        
        $partner = Role::select('id')->where('name', 'partner')->first();
        $vendor = Role::select('id')->where('name', 'vendor')->first();
        
        Jobcategory::create([
            'name' => 'Sales',
            'plan' => $partner->id
        ]);
        
        Jobcategory::create([
            'name' => 'Marketing',
            'plan' => $partner->id
        ]);
        
        Jobcategory::create([
            'name' => 'Channel Manager',
            'plan' => $vendor->id
        ]);
        
        Jobcategory::create([
            'name' => 'Channel Marketing',
            'plan' => $vendor->id
        ]);
    }
}
