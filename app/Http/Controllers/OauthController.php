<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class OauthController extends Controller
{
    const PLATFORM_TWITTER = 'twitter';
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param string $platform
     * @return mixed
     */
    public function redirect(string $platform)
    {
        if ($this->isSupportedPlatform($platform)) {
            return \Socialite::with($platform)->redirect();
        }
        // TODO: handle exception
    }

    /**
     * @param string $platform
     */
    public function callback(string $platform)
    {
        if ($this->isSupportedPlatform($platform)) {
            $callbackUser = \Socialite::with($platform)->user();
            $user = $this->userService->getUserByCallbackUser($platform, $callbackUser);
            echo "Hi " . $user->name;
        }
        // TODO: handle exception
    }

    /**
     * @param string $platform
     * @return bool
     */
    public function isSupportedPlatform(string $platform): bool
    {
        $supportedList = [
            static::PLATFORM_TWITTER,
        ];

        return in_array($platform, $supportedList);
    }
}
