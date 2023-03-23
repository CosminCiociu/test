<?php

use App\Company;
use App\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = Company::find(1);
        $company2 = Company::find(2);

        $project1 = new Project([
            'name'              => 'project1',
            'description'       => 'Description 1',
            'start_date'        => date('Y-m-d'),
            'end_date'          => date('Y-m-d'),
        ]);

        $project2 = new Project([
            'name'              => 'project2',
            'description'       => 'Description 2',
            'start_date'        => date('Y-m-d'),
            'end_date'          => date('Y-m-d'),
        ]);

        $project3 = new Project([
            'name'              => 'project3',
            'description'       => 'Description 3',
            'start_date'        => date('Y-m-d'),
            'end_date'          => date('Y-m-d'),
        ]);
        

        $company1->projects()->save($project1);
        $company1->projects()->save($project2);
        $company2->projects()->save($project3);
    }
}
