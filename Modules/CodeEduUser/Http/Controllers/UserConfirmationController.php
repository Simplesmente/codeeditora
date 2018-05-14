<?php

namespace CodeEduUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Jrean\UserVerification\Traits\VerifiesUsers;
use CodeEduUser\Repositories\UserRepository;

class UserConfirmationController extends Controller
{
   use VerifiesUsers;

   private $user;

    public function __construct(UserRepository $model)
    {
        $this->user = $model;
    }

    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('codeeduuser.user_settings.edit');
    } 

    private function loginUser()
    {
        $email = \Request::get('email');
        $user = $this->user->findByField('email',$email)->first();
        
        \Auth::login($user);
    }
}
