<?php
namespace CodePub\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByTitleCriteria implements CriteriaInterface
{
    /**
     * Title for query
     *
     * @var [string]
     */
    private $title;
    
    public function __construct(string $title)
    {
        $this->title = $title;
    }
    
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('title', $this->title);
    }
}
