<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Models\Book;
use CodeEduBook\Http\Requests\CategoryRequest;
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

        if (is_null($paramFromRoute)) {
            return true;
        }
        
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
        $id = null;
        $book = null;
        

        if ($book = $this->route('book') instanceof Book) {
            $id = $book->id;
        }

        if ($book = $this->route('book')) {
            $id = $book;
        }
        
        return [
            'title' => "required|unique:books,title,$id|max:255",
            'subtitle' => "required|max:255",
            'price' => "required|max:255",
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ];
    }

    
    public function messages()
    {
        $result = [];

        $categories = $this->get('categories', []);
        $count = count($categories);

        if (is_array($categories) && $count > 0) {
            foreach (range(0, $count -1) as $value) {
                $field = \Lang::get('validation.attributes.categories_*', ['num' => $value + 1]);
            }
            $message = \Lang::get('validation.exists', ['attributes' => $field]);

            $result["categories.$value.exists"] = $message;
        }

        return $result;
    }
}
