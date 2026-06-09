<?php

namespace Database\Seeders;

use App\Models\Bootcamp;
use App\Models\News;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan kita sudah memiliki user Admin atau Super Admin dari UserSeeder
        $admin = User::where('role', 'admin')->first() ?? User::factory()->admin()->create();

        Scholarship::factory(10)->create([
            'created_by' => $admin->id,
        ]);

        Bootcamp::factory(10)->create([
            'created_by' => $admin->id,
        ]);

        News::factory(10)->create([
            'author_id' => $admin->id,
        ]);
    }
}
