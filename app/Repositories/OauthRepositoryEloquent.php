<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OauthRepository;
use App\Models\Oauth;
use App\Validators\OauthValidator;

/**
 * Class OauthRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OauthRepositoryEloquent extends BaseRepository implements OauthRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Oauth::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
