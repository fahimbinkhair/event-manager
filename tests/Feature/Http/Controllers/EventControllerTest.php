<?php

namespace Tests\Feature;

use App\Http\Constants;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventControllerTest extends TestCase
{
    public function testCanAccessTheViewEventPageWhereStatusIsActive()
    {
        $response = $this->get(route('view-events', ['status' => Constants::STATUS_ACTIVE]));

        $response->assertStatus(200);
    }

    public function testCanAccessTheViewEventPageWhereStatusIsArchived()
    {
        $response = $this->get(route('view-events', ['status' => Constants::STATUS_ARCHIVED]));

        $response->assertStatus(200);
    }

    public function testFailToAccessTheViewEventPageWhereStatusIsUnexpected()
    {
        $response = $this->get(route('view-events', ['status' => 'BAD_GUY']));

        $response->assertStatus(404);
    }
}
