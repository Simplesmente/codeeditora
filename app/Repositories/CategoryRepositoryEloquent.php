<?php

namespace CodePub\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\CategoryRepository;
use CodePub\Models\Category;
use CodePub\Validators\CategoryValidator;
use CodePub\Criteria\CriteriaTrashedTrait;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{

    use CriteriaTrashedTrait;

    protected $fieldSearchable = [
        'name'=>'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {

      /**
       * @var Collection \$[$collection] [Collection of data fetched from database]
       */
      $collection = $this->all();
      return $collection->pluck($column,$key);

    }
}
