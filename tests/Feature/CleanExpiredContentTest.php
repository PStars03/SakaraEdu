<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Scholarship;
use App\Models\Bootcamp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class CleanExpiredContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_clean_expired_content_command_deletes_expired_posts()
    {
        // Expired yesterday
        $expiredScholarship = Scholarship::factory()->create([
            'end_date' => Carbon::yesterday()->toDateString(),
            'status' => 'published'
        ]);

        $expiredBootcamp = Bootcamp::factory()->create([
            'end_date' => Carbon::yesterday()->toDateString(),
            'status' => 'published',
            'is_paid' => false,
            'price' => null
        ]);

        // Active today
        $activeScholarship = Scholarship::factory()->create([
            'end_date' => Carbon::today()->toDateString(),
            'status' => 'published'
        ]);

        $activeBootcamp = Bootcamp::factory()->create([
            'end_date' => Carbon::tomorrow()->toDateString(),
            'status' => 'published',
            'is_paid' => false,
            'price' => null
        ]);

        // Run command
        Artisan::call('app:clean-expired');

        // Assert expired posts are soft deleted
        $this->assertSoftDeleted('scholarships', ['id' => $expiredScholarship->id]);
        $this->assertSoftDeleted('bootcamps', ['id' => $expiredBootcamp->id]);

        // Assert active posts remain (not soft deleted)
        $this->assertNotSoftDeleted('scholarships', ['id' => $activeScholarship->id]);
        $this->assertNotSoftDeleted('bootcamps', ['id' => $activeBootcamp->id]);
    }
}
