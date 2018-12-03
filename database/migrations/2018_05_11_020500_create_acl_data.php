<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use CodeEduUser\Entities\Role;
use CodeEduUser\Entities\User;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $role = Role::create([
         'name'=>'Admin',
         'description' => 'Administrador capaz de efetuar qualquer ação no sistema'        
       ]); 
       
       $user = $this->getUser();
       $user->roles()->save($role);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $role = Role::where('name','Admin')->first();
        $user = $this->getUser();
        $user->roles()->detach($role->id);
        $role->delete();
    }

    private function getUser()
    {
        return User::where('email',config('codeeduuser.user_default.email'))->first();
    }
}
