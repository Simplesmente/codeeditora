<?php

namespace CodePub\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Models' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       
        Gate::define('update-book',function($user,$model){
            return $user->id == $model->author_id; 
        });

        Gate::before(function($user,$ability){
            if($user->isAdmin()) {
                return true;    
            }
        });
        
        $permissionRepository = app(\CodeEduUser\Repositories\PermissionRepositoryEloquent::class);
        
        $permissionRepository->pushCriteria( new \CodeEduUser\Criteria\FindPermissionResourceCriteria());
        $permissions = $permissionRepository->all();
        
        foreach($permissions as $p) {
            Gate::define("{$p->name}/{$p->resource_name}",function($user) use ($p) {
                return $user->hasRole($p->roles);
            });
        }

    }
}
