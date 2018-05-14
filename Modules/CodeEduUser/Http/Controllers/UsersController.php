<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Http\Requests\UserDeleteRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    private $user;

    public function __construct(UserRepository $model)
    {
        $this->user = $model;
    }

    public function index()
    {
        $users = $this->user->paginate(15);
        
        return view('codeeduuser::users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('codeeduuser::users.create');
    }

    public function store(UserRequest $request)
    {
        $this->user->create($request->all());

        $urlPrevious = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');
        return redirect()->to($urlPrevious);
    }

    public function edit($id)
    {
        if (! ($user = $this->user->find($id))) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }

        return view('codeeduuser::users.edit', ['user'=> $user]);
    }

    public function update(UserRequest $request, $id)
    {
        if (! ($user = $this->user->find($id))) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }

        $data = $request->except(['password']);
        $user->update($data,$id=[]);
        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('codeeduuser.users.index'));
        return redirect()->to($urlPrevious);
    }

    public function destroy(UserDeleteRequest $request,$id)
    {
        if (! ($user = $this->user->find($id))) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }

        $user->delete();
        \Session::flash('message', 'Usuário excluído com sucesso.');

        return redirect()->route('codeeduuser.users.index');
    }
}
