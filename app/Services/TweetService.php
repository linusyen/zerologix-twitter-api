<?php

namespace App\Services;

use App\Repositories\FollowingRepository;
use App\Repositories\TweetRepository;

/**
 * Class TweetService
 * @package App\Services
 */
class TweetService
{
    /**
     * @var TweetRepository
     */
    private $tweet;
    /**
     * @var FollowingRepository
     */
    private $following;

    public function __construct(TweetRepository $tweet, FollowingRepository $following)
    {
        $this->tweet = $tweet;
        $this->following = $following;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->tweet->create($params);
    }
}
