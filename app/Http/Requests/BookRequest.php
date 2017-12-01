<?php

namespace App\Http\Requests;

use App\Book;
use App\Http\Requests\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**@var Book */
        $book = null;
        
        /** @var Book|int*/
        $paramFromRoute = $this->route('book');

        if ($paramFromRoute instanceof Book) {
            $book = $paramFromRoute;
        }

        if (is_numeric($paramFromRoute)) {
            $book = Book::find($paramFromRoute);
        }
                
        if (\Auth::user()->id === $book->author->id) {
            return true;
        }
       
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => "required|unique:books,title|max:255",
            'subtitle' => "required|max:255",
            'price' => "required|max:255",
        ];
    }

    
    public function messages()
    {
        return [
            'title.required' => 'O nome é obrigatório!',
            'title.unique' => 'Título já existe!',
            'title.max' => 'Título deve conter no máximo 255!',
            
            'subtitle.required' => 'Subtítulo é obrigatório!',
            'subtitle.max' => 'Subtítulo deve conter no máximo 255!',

            'price.required' => 'Preço é obrigatório!',
            'price.max' => 'Preço deve conter no máximo 255!',
        ];
    }
}
