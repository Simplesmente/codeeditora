<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;

use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Criteria\FindOnlyTrashedCriteria;

class BookTrashedController extends Controller
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
        $books = $this->book->onlyTrashed()->paginate(15);

        $search = $request->get('search');

        return view('codeedubook::trashed.books.index', compact('books', 'search'));
    }

    public function show($id)
    {
        $this->book->onlyTrashed();
        $book = $this->book->find($id);

        return view('codeedubook::trashed.books.show', compact('book'));
    }

    public function update(Request $request,$id)
    {
      $this->book->onlyTrashed();
      $this->book->restore($id);
      $request->session()->flash('message', 'Livro restaurado com sucesso.');
      $urlPrevious = $request->get('redirect_to', route('trashed.books.index'));

      return redirect()->to($urlPrevious);
    }

}
