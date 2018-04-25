<?php

namespace CodeEduBook\Repositories;


use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use CodeEduBook\Criteria\CriteriaTrashedInterface;
use CodeEduBook\Repositories\RepositoryRestoreInterface;

/**
 * Interface BookRepository
 * @package namespace CodeEduBook\Repositories;
 */
interface BookRepository extends RepositoryInterface,RepositoryCriteriaInterface,CriteriaTrashedInterface,RepositoryRestoreInterface
{
    //
}
