<?php

namespace CodeEduBook\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Entities\Book;
use CodeEduBook\Validators\BookValidator;
use CodeEduBook\Criteria\CriteriaTrashedTrait;
use CodeEduBook\Repositories\RepositoryRestoreTrait;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodeEduBook\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{

    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title'=>'like',
        'author.name'=>'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->categories()->sync($attributes['categories']);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
