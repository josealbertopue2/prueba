<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        // Crea 50 tareas de prueba
        Task::factory()->count(50)->create();
    }
}
