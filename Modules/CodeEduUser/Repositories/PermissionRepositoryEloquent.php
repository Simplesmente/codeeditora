<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Entities\Permission;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace CodeEduUser\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{

  

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
