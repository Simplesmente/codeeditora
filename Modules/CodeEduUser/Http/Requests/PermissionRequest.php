<?php

namespace CodeEduUser\Http\Requests;

use CodeEduUser\Entities\Role;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {    
        $id = null;
        $role = null;
        

        if ($role = $this->route('role') instanceof \CodeEduUser\Entities\Permission) {
            $id = $role->id;
        }

        if ($role = $this->route('role')) {
            $id = $role;
        }

        return [
      //      'permissions' => "required|array",
            'permissions.*' => "exists:permissions,$id"
        ];
    }
   
    /**
    *
    * public function messages()
    *  {
    *    return [
    *        'name.required' => 'O nome é obrigatório!',
    *        'name.max' => 'O máximo de caractes é 255!',
    *        'name.unique' => 'O nome já existe!',
    *    ];
    *  }
    */
}
