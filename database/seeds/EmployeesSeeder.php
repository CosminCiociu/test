<?php

use App\Company;
use App\Employee;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $company1 = Company::find(1);
        $company2 = Company::find(2);

        $employee1 = new Employee([
            'name'              => 'employ1',
            'phone'             => '0725697875',
            'email'             => 'employee1@employee1.com',
            'password'          => bcrypt('employee1'),
            'email_verified_at' => date('Y-m-d')
        ]);
        $employee2 = new Employee([
            'name'              => 'employee2',
            'phone'             => '0725697875',
            'email'             => 'employee2@employee2.com',
            'password'          => bcrypt('employee2'),
            'email_verified_at' => date('Y-m-d')
        ]);
        $employee3 = new Employee([
            'name'              => 'employee3',
            'phone'             => '0725697875',
            'email'             => 'employee3@employee3.com',
            'password'          => bcrypt('employee3'),
            'email_verified_at' => date('Y-m-d')
        ]);

        $company1->employees()->save($employee1);
        $company1->employees()->save($employee2);
        $company2->employees()->save($employee3);
    }
}
