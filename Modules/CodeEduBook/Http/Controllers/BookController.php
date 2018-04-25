<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Http\Requests\BookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    /**
     * Repository Book
     *
     * @var [CodeEduBook\Repositories\BookRepository]
     */
    private $book;

    public function __construct(BookRepository $model)
    {
        $this->book = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->book->paginate(15);
        $search = $request->get('search');

        return view('codeedubook::books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $category)
    {
        $categories = $category->pluck('name', 'id');

        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CodeEduBook\Http\Requests\BookRequest  $request
     */
    public function store(BookRequest $request)
    {
        $dataFromRequest = $request->all();
        $dataFromRequest['user_id'] = \Auth::user()->id;

        $this->book->create($dataFromRequest);
        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('books.index'));
        return redirect()->to($urlPrevious);
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeEduBook\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeEduBook\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CategoryRepository $category)
    {
      //  $categories = $category->pluck('name', 'id');

        $category->withTrashed();
        
        $categories = $category->listsWithMutators('name_trashed', 'id');

        if (! ($book = $this->book->find($id))) {
            throw new ModelNotFoundException('Livro não encontrado');
        }

        return view('codeedubook::books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CodeEduBook\Http\Requests\BookRequest  $request
     * @param  \CodeEduBook\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        if (! ($book = $this->book->find($id))) {
            throw new ModelNotFoundException('Livro não encontrado');
        }

        $dataFromRequest = $request->except('user_id');

        $this->book->update($dataFromRequest,$id);

        $request->session()->flash('message', 'Livro atualizado com sucesso.');
        $urlPrevious = $request->get('redirect_to', route('books.index'));
        return redirect()->to($urlPrevious);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \CodeEduBook\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! ($book = $this->book->find($id))) {
            throw new ModelNotFoundException('Livro não encontrado');
        }

        $book->delete();
        \Session::flash('message', 'Livro deletado com sucesso.');
        return redirect()->route('books.index');
    }
}
