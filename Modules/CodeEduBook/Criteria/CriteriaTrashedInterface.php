<?php
namespace CodeEduBook\Criteria;

interface CriteriaTrashedInterface
{
    public function onlyTrashed();

    public function withTrashed();
}
