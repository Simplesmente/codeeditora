<?php

namespace CodeEduUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Http\Requests\UserSettingsRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CodeEduUser\Annotations\Mapping\Controller as ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\Action as ActionAnnotation;


class UserSettingsController extends Controller
{

    private $user;

    public function __construct(UserRepository $model)
    {
        $this->user = $model;
    }

     /**
     *
     * @return void
     */
    public function edit()
    {
        $user = \Auth::user();

        return view('codeeduuser::users-settings.settings', ['user'=> $user]);
    }

     /**
     *
     * @return void
     */

    public function update(UserSettingsRequest $request)
    {
        $user = \Auth::user();

        $this->user->update($request->all(),$user->id);
        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        return route('codeeduuser.user_settings.edit');
    }
}
