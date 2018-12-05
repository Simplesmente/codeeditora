<?php
namespace CodeEduUser\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEduUser\Annotations\PermissionReader as Reader;

class PermissionReader extends Facade
{
    public static function getFacadeAccessor()
    {
        return Reader::class;
    }
}