<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\PermissionRepository; 
use CodeEduUser\Http\Requests\PermissionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use CodeEduUser\Annotations\Mapping\Controller as ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\Action as ActionAnnotation;


/**
 * @ControllerAnnotation(name="roles-admin",description="Perfis de usuário")
 */
class RolesController extends Controller
{
    private $role;

    private $permission;

    public function __construct(RoleRepository $model, PermissionRepository $permission)
    {
        $this->role = $model;

        $this->permission = $permission;
    }

     /**
     * @ActionAnnotation(name="list",description="Listar Perfil de Usuário")
     *
     * @return void
     */
    public function index()
    {
        $roles = $this->role->paginate(15);
        
        return view('codeeduuser::roles.index', ['roles' => $roles]);
    }

     /**
     * @ActionAnnotation(name="list",description="Listar Perfil de Usuário")
     *
     * @return void
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    public function store(RoleRequest $request)
    {
        $this->role->create($request->all());

        $urlPrevious = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Role cadastrada com sucesso.');
        return redirect()->to($urlPrevious);
    }

    /**
     * @ActionAnnotation(name="update",description="Atualização Perfil de Usuário")
     *
     * @return void
     */

    public function edit($id)
    {
        if (! ($role = $this->role->find($id))) {
            throw new ModelNotFoundException('Role não encontrada');
        }

        return view('codeeduuser::roles.edit', ['role'=> $role]);
    }

    /**
     * @ActionAnnotation(name="update",description="Atualização Perfil de Usuário")
     *
     * @return void
     */

    public function update(RoleRequest $request, $id)
    {
        if (! ($role = $this->role->find($id))) {
            throw new ModelNotFoundException('Role não encontrada');
        }

        $data = $request->except('permissions');
        $role->update($data,$id=[]);
        $request->session()->flash('message', 'Role atualizada com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('codeeduuser.roles.index'));
        return redirect()->to($urlPrevious);
    }

    /**
     * @ActionAnnotation(name="destroy",description="Remover Perfil de Usuário")
     *
     * @return void
     */

    public function destroy($id)
    {
        if (! ($role = $this->role->find($id))) {
            throw new ModelNotFoundException('Role não encontrada');
        }

        try{
            $role->delete();
            \Session::flash('message', 'Role excluída com sucesso.');
        }catch(\Illuminate\Database\QueryException $e){
            \Session::flash('error', 'Role não pode ser excluída pois algum usuários está usando.');
        }
        
        return redirect()->route('codeeduuser.roles.index');
    }

     /**
     * @ActionAnnotation(name="edit-permission",description="Editar Permissões de Usuários")
     *
     * @return void
     */
    public function editPermission(PermissionRequest $request, $id)
    {
        
        $role = $this->role->find($id);
        $this->permission->pushCriteria(new \CodeEduUser\Criteria\FindPermissionResourceCriteria);
        $permissions = $this->permission->all();

        $this->permission->resetCriteria();

        $this->permission->pushCriteria(new \CodeEduUser\Criteria\FindPermissionGroupCriteria);
        $permissionGroup = $this->permission->all(['name','description']);
             
        return view('codeeduuser::roles.permissions',compact('role','permissions','permissionGroup'));
    }

     /**
     * @ActionAnnotation(name="update-permission",description="Editar Permissões de Usuários")
     *
     * @return void
     */
    public function updatePermission(Request $request,$id)
    {
        $data = $request->only('permissions');
       
        $this->role->update($data,$id);
        $request->session()->flash('message', 'Permissões atribuídas com sucesso.');

        return redirect()->route('codeeduuser.roles.index');
    }
}
