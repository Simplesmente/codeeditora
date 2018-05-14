<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Http\Requests\CategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    private $book;


    public function __construct(BookRepository $book)
    {
        $this->book = $book;
    }

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
            $book = $this->book->find($paramFromRoute);
        }
       
        return \Gate::allows('update-book',$book);
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
}
