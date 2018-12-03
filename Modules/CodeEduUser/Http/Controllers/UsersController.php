<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Http\Requests\UserDeleteRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CodeEduUser\Annotations\Mapping\Controller as ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\Action as ActionAnnotation;

/**
 * @ControllerAnnotation(name="users-admin",description="Administração de Usuários")
 */
class UsersController extends Controller
{
    private $user;

    private $roles;

    public function __construct(UserRepository $model,RoleRepository $role)
    {
        $this->user = $model;
        $this->roles = $role;
    }

    /**
     * @ActionAnnotation(name="list",description="Ver listagem de usuário")
     *
     * @return void
     */
    public function index()
    {
        $users = $this->user->paginate(15);
        
        return view('codeeduuser::users.index', ['users' => $users]);
    }

    /**
     * @ActionAnnotation(name="store",description="Criar usuário")
     *
     * @return void
     */
    public function create()
    {
        $roles = $this->roles->all()->pluck('name','id');
        return view('codeeduuser::users.create',compact('roles'));
    }

    /**
     * @ActionAnnotation(name="store",description="Criar usuário")
     *
     * @return void
     */
    public function store(UserRequest $request)
    {
        $this->user->create($request->all());

        $urlPrevious = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');
        return redirect()->to($urlPrevious);
    }

    /**
     * @ActionAnnotation(name="update",description="Atualizar usuário")
     *
     * @return void
     */
    public function edit($id)
    {
        if (! ($user = $this->user->find($id))) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }

        $roles = $this->roles->all()->pluck('name','id');

        return view('codeeduuser::users.edit', ['user'=> $user,'roles' => $roles]);
    }

    /**
     * @ActionAnnotation(name="update",description="Atualizar usuário")
     *
     * @return void
     */

    public function update(UserRequest $request, $id)
    {
        if (! ($user = $this->user->find($id))) {
            throw new ModelNotFoundException('Usuário não encontrado');
        }
        
        $data = $request->except(['password']);

        $this->user->update($data,$id);
        $request->session()->flash('message', 'Usuário atualizado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('codeeduuser.users.index'));
        return redirect()->to($urlPrevious);
    }

    /**
     * @ActionAnnotation(name="destroy",description="Excluir usuário")
     *
     * @return void
     */
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
