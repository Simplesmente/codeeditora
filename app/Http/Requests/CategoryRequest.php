<?php

namespace CodePub\Http\Requests;

use CodePub\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = null;
        

        if ($category = $this->route('category') instanceof Category) {
            $id = $category->id;
        }

        if ($category = $this->route('category')) {
            $id = $category;
        }
        
        return [
            'name' => "required|unique:categories,name,$id|max:255"
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
