<?php

namespace CodeEduUser\Http\Requests;

use CodeEduUser\Entities\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = null;
        

        if ($user = $this->route('user') instanceof User) {
            $id = $user->id;
        }

        if ($user = $this->route('user')) {
            $id = $user;
        }
        
        return [
            'name' => "required|max:255",
            'email' => "required|unique:users,email,$id|max:255",
            'roles.*' => 'exists:roles,id'
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
