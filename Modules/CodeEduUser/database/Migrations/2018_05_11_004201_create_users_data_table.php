<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;

use CodeEduUser\Entities\User;

class CreateUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();

        User::create([
            'name' => config('codeeduuser.user_default.name'),
            'email' => config('codeeduuser.user_default.email'),
            'password' => bcrypt(config('codeeduuser.user_default.password')),
            'verified' => true
        ]);

        Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Scheam::disableForeignKeyConstraints();

        $user = User::where('email',config('codeeduuser.user_default.email'))->first();
        $user->forceDelete();

        \Scheam::enableForeignKeyConstraints();
    }
}
