<?php

namespace CodeEduUser\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use CodeEduUser\Annotations\PermissionReader;

class AuthorizationResource
{

    private $reader;

    public function __construct(PermissionReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentAction = \Route::currentRouteAction();
       
        list($controller,$action) = explode('@',$currentAction);
        $permission = $this->reader->getPermission($controller,$action);

        if(count($permission)) {

            $permission = $permission[0];
            
            if(! \Gate::allows("{$permission['name']}/{$permission['resource_name']}") ) {
                throw new \Illuminate\Auth\Access\AuthorizationException('Usuário não autorizado');
            }
        }
        return $next($request);
    }
}
