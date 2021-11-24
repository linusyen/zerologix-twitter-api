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

    /**
     * @param int $id
     * @return mixed
     */
    public function getTweets(int $id)
    {
        return $this->tweet->findByField('user_id', $id);
    }
}
