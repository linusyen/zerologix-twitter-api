<?php

namespace App\Services;

use App\Repositories\OauthRepository;
use App\Repositories\UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var OauthRepository
     */
    private $oauth;
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(UserRepository $user, OauthRepository $oauth)
    {
        $this->oauth = $oauth;
        $this->user = $user;
    }

    /**
     * @param string $platform
     * @param $callbackUser
     * @return array|mixed
     */
    public function getUserByCallbackUser(string $platform, $callbackUser)
    {
        /* @var \Illuminate\Database\Eloquent\Collection $oauth */
        $oauth = $this->oauth->findByField('platform_id', $callbackUser->id);
        if ($oauth->isEmpty()) {
            // Create new user
            $user = $this->user->create([
                'name' => $callbackUser->name,
                'email' => $callbackUser->email,
            ]);
            $this->oauth->create([
                'user_id' => $user->id,
                'platform' => $platform,
                'platform_id' => $callbackUser->id,
                'token' => $callbackUser->token,
                'payload' => json_encode($callbackUser),
            ]);
        } else {
            // login
            $user = $this->user->find($oauth->first()->user_id);
        }

        return $user;
    }

    /**
     * @param int $userId
     * @param int $oauthId
     * @param $accessToken
     * @param $ts
     * @return bool
     */
    public function checkUserToken(int $userId, int $oauthId, $accessToken, $ts): bool
    {
        /* @var \Illuminate\Database\Eloquent\Collection $oauth */
        $oauth = $this->oauth->findWhere([
            'id' => $oauthId,
            'user_id' => $userId,
        ]);

        if ($oauth->isEmpty()) {
            return false;
        }
        return hash('sha256', $oauth->first()->token . $ts) == $accessToken;
    }
}
