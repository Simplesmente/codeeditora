<?php

namespace CodePub\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use CodePub\Criteria\CriteriaOnlyTrashedInterface;
/**
 * Interface BookRepository
 * @package namespace CodePub\Repositories;
 */
interface BookRepository extends RepositoryInterface, RepositoryCriteriaInterface,CriteriaOnlyTrashedInterface
{
    //
}
