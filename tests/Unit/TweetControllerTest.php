<?php

namespace Tests\Unit;

use App\Models\Tweet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TweetControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetTimeline()
    {
        Tweet::factory()->count(3)->create();
        $response = $this->get('api/users/1/timeline');

        $this->assertCount(3, $response['data']);
        $this->assertEquals('success', $response['status']);
    }
}
