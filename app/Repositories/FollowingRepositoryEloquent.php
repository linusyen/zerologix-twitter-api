<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FollowingRepository;
use App\Models\Following;
use App\Validators\FollowingValidator;

/**
 * Class FollowingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FollowingRepositoryEloquent extends BaseRepository implements FollowingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Following::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
