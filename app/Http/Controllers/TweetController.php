<?php

namespace App\Http\Controllers;

use App\Services\TweetService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * @var TweetService
     */
    private $tweetService;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService, TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'user_id' => ['required', "integer"],
            'oauth_id' => ['required', "integer"],
            'access_token' => ['required'],
            'content' => ['required'],
            'ts' => ['required'],
        ]);

        // Check user's token
        if (!$this->userService->checkUserToken(
            $request->get('user_id'),
            $request->get('oauth_id'),
            $request->get('access_token'),
            $request->get('ts')
        )) {
            return $this->fail();
        }

        // Create new tweet
        $params = [
            'user_id' => $request->get('user_id'),
            'content' => $request->get('content'),
        ];

        $tweet = $this->tweetService->create($params);

        return $this->success($tweet);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTweets(int $id): \Illuminate\Http\JsonResponse
    {
        $tweets = $this->tweetService->getTweets($id);

        return $this->success($tweets);
    }
}
