<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Material;
use App\Models\Project;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        $projects = [
            ['name' => 'Kigali Heights Tower', 'location' => 'Kigali, Gasabo', 'status' => 'in_progress', 'progress_percent' => 65, 'start_date' => '2025-09-01', 'end_date' => '2026-06-30', 'description' => 'Commercial building construction'],
            ['name' => 'Remera Road Upgrade', 'location' => 'Kigali, Remera', 'status' => 'planning', 'progress_percent' => 15, 'start_date' => '2026-02-01', 'end_date' => '2026-12-31', 'description' => 'Road rehabilitation project'],
            ['name' => 'Nyamata Housing Estate', 'location' => 'Bugesera, Nyamata', 'status' => 'delayed', 'progress_percent' => 40, 'start_date' => '2025-06-01', 'end_date' => '2026-03-31', 'description' => 'Residential housing units'],
        ];

        foreach ($projects as $data) {
            Project::create($data);
        }

        $workers = [
            ['name' => 'Jean Pierre Uwimana', 'role' => 'Site Manager', 'phone' => '+250788100001'],
            ['name' => 'Alice Mukamana', 'role' => 'Civil Engineer', 'phone' => '+250788100002'],
            ['name' => 'Eric Nshimiyimana', 'role' => 'Mason', 'phone' => '+250788100003'],
            ['name' => 'Grace Uwase', 'role' => 'Electrician', 'phone' => '+250788100004'],
            ['name' => 'Patrick Habimana', 'role' => 'Laborer', 'phone' => '+250788100005'],
        ];

        foreach ($workers as $data) {
            Worker::create($data);
        }

        $materials = [
            ['name' => 'Cement (50kg bags)', 'quantity' => 500, 'unit' => 'bags'],
            ['name' => 'Steel Rebar 12mm', 'quantity' => 2000, 'unit' => 'kg'],
            ['name' => 'Sand', 'quantity' => 150, 'unit' => 'm³'],
            ['name' => 'Gravel', 'quantity' => 120, 'unit' => 'm³'],
            ['name' => 'Bricks', 'quantity' => 10000, 'unit' => 'pieces'],
        ];

        foreach ($materials as $data) {
            Material::create($data);
        }

        Assignment::create(['project_id' => 1, 'worker_id' => 1, 'assigned_date' => '2025-09-05', 'notes' => 'Overall site supervision']);
        Assignment::create(['project_id' => 1, 'worker_id' => 2, 'assigned_date' => '2025-09-05', 'notes' => 'Structural oversight']);
        Assignment::create(['project_id' => 1, 'worker_id' => 3, 'assigned_date' => '2025-09-10', 'notes' => 'Masonry work']);
        Assignment::create(['project_id' => 2, 'worker_id' => 2, 'assigned_date' => '2026-02-05', 'notes' => 'Planning phase']);
        Assignment::create(['project_id' => 3, 'worker_id' => 1, 'assigned_date' => '2025-06-10', 'notes' => 'Catch-up management']);

        $p1 = Project::find(1);
        $p1->materials()->sync([
            1 => ['quantity_used' => 120],
            2 => ['quantity_used' => 800],
            3 => ['quantity_used' => 45],
        ]);
    }
}
