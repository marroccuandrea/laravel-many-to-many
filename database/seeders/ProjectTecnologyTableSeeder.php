<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Tecnology;

class ProjectTecnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $project = Project::inRandomOrder()->first();

            $tecnology_id = Tecnology::inRandomOrder()->first()->id;

            $project->tecnologies()->attach($tecnology_id);
        }
    }
}
