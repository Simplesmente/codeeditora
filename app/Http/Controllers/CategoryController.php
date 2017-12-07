<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $model)
    {
        $this->category = $model;
    }

    public function index()
    {
        $categories = $this->category->query()->paginate(15);
        
        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        
        $urlPrevious = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria cadastrada com sucesso.');
        return redirect()->to($urlPrevious);
    }

    public function edit($id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }

        return view('categories.edit', ['category'=> $category]);
    }

    public function update(CategoryRequest $request, $id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }

        $data = $request->all();
        $category->fill($data);
        $category->save();
        $urlPrevious = $request->get('redirect_to', route('categories.index'));
        return redirect()->to($urlPrevious);
    }

    public function destroy($id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }
        
        $category->delete();
        \Session::flash('message', 'Categoria cadastradas com sucesso.');
        
        return redirect()->route('categories.index');
    }
}
