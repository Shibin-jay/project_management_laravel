<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Shibin Siyad',
            'email' => 'shibin@example.com',
            'password' => bcrypt('password'),
        ]);

        $project = Project::create([
            'title' => 'Test Project',
            'description' => 'This is a sample project.',
            'user_id' => $user->id
        ]);

        Task::create([
            'title' => 'Sample Task',
            'status' => 'Pending',
            'project_id' => $project->id
        ]);
    }
}
