<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Criteria\CriteriaTrashedInterface;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodeEduBook\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, CriteriaTrashedInterface
{
    public function listsWithMutators($column, $key = null);
}
