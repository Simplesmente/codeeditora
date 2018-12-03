<?php

namespace CodeEduUser\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;

class User extends Authenticatable implements TableInterface
{
    use Notifiable,SoftDeletes,FormAccessible;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function formRolesAttribute()
    {
        return $this->roles->pluck('id')->all();
    }

    public static function generatePassword($password=null) {
        return  !$password ? bcrypt(str_random(8)) : bcrypt($password);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * A list of headers to be used when a table is displayed
    *
    * @return array
    */
    public function getTableHeaders()
    {
        return [ 'ID','Nome','Email','Roles'];
    }

     /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        if ($header === 'ID') {
            return $this->id;
        }
        if ($header === 'Nome') {
            return $this->name;
        }
        if ($header === 'Email') {
            return $this->email;
        }
        if ($header === 'Roles') {
            return $this->roles->implode('name','|');
        }
    }

    /**
     * 
     * @param [Collection|String] $role
     */
    public function hasRole($role) 
    {
        return is_string($role) ?
            $this->roles->contains('name',$role) :
            $this->roles->intersect($this->roles)->count();

    }

    public function isAdmin() {
        return $this->hasRole(config('codeeduuser.acl.role_admin'));
    }
}
