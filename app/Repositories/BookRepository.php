<?php

namespace CodePub\Repositories;


use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use CodePub\Criteria\CriteriaTrashedInterface;
use CodePub\Repositories\RepositoryRestoreInterface;

/**
 * Interface BookRepository
 * @package namespace CodePub\Repositories;
 */
interface BookRepository extends RepositoryInterface,RepositoryCriteriaInterface,CriteriaTrashedInterface,RepositoryRestoreInterface
{
    //
}
