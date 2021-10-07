<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear current table data
        Role::truncate();
        
        // add new role in table
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'partner']);
        Role::create(['name' => 'vendor']);
    }
}
