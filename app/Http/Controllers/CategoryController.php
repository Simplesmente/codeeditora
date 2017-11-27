<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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

    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }

        return view('categories.edit', ['category'=> $category]);
    }

    public function update(Request $request, $id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }

        $data = $request->all();
        $category->fill($data);
        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy(Request $request, $id)
    {
        if (! ($category = $this->category->find($id))) {
            throw new ModelNotFoundException('Categoria não encontrada');
        }
        
        $category->delete();

        return redirect()->route('categories.index');
    }
}
