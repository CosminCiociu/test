<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name'              => 'company 1',
            'address'           => 'Address 1',
        ]);
        Company::create([
            'name'              => 'company 2',
            'address'           => 'Address 2',
        ]);
        Company::create([
            'name'              => 'company 3',
            'address'           => 'Address 3',
        ]);
    }
}
