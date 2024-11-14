<?php

namespace Tests\Feature;

use App\Enums\Type;
use App\Models\Attendance;
use App\Models\DetailService;
use App\Models\GroupService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class attendanceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_createAttendance():void{
        $user = User::create([
            'ci' => 12345678,
            'surname' => 'anonimo',
            'name' => 'oculto',
            'range' => 'sargento',
            'cellular' => 61813282,
            'username' => 'anonimo12345678',
            'password' => '12345678'
        ]);
        $service = Service::create([
            'title' => 'plan mercados',
            'date' => now(),
            'status' => 1,
            'lat' => 0.1111,
            'long' => 123.22
        ]);
        $group = GroupService::create([
            'service_id' => $service->id,
            'user_id' => $user->id,
            'lat' => 12.22,
            'long' => 123.33
        ]);

        $detail = DetailService::create([
            'group_service_id' => $group->id,
            'service_id' => $service->id,
            'user_id' => $user->id
        ]);
        $attendace = Attendance::create([
            'detail_service_id' => $detail->id,
            'type' => Type::MANUAL
        ]);

        $this->assertNotNull($attendace,'no se pudo crear attendance');
        $this->assertNotNull($attendace->detailService,'no se puede acceder a detailServices');
    }
}
