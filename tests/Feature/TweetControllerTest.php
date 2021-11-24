<?php

namespace Tests\Feature;

use App\Models\Oauth;
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

        $response->assertStatus(200);
        $this->assertCount(3, $response['data']);
        $this->assertEquals('success', $response['status']);
    }

    public function testCreate()
    {
        $oauth = Oauth::factory()->create();
        $ts = strtotime('2021-11-20');
        $request = [
            'user_id' => $oauth->user_id,
            'oauth_id' => $oauth->id,
            'access_token' => hash('sha256', $oauth->token . $ts),
            'content' => 'test123',
            'ts' => $ts,
        ];
        $response = $this->post('api/tweets', $request);

        $response->assertStatus(200);
        $this->assertEquals('success', $response['status']);
    }


    public function testCreateTokenFail()
    {
        $oauth = Oauth::factory()->create();
        $ts = strtotime('2021-11-20');
        $request = [
            'user_id' => $oauth->user_id,
            'oauth_id' => $oauth->id,
            'access_token' => 'fail_token',
            'content' => 'test123',
            'ts' => $ts,
        ];
        $response = $this->post('api/tweets', $request);

        $response->assertStatus(400);
        $this->assertEquals('fail', $response['status']);
    }


    public function testGetTweets()
    {
        Tweet::factory()->count(3)->create();
        $response = $this->get('api/users/1/tweets');

        $response->assertStatus(200);
        $this->assertCount(3, $response['data']);
        $this->assertEquals('success', $response['status']);
    }
}
