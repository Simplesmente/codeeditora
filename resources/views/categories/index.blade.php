@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de categories</h3>   
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Nova Categoria</a>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <ul>
                                    <li> 
                                        <a href="{{ route('categories.edit',['category' => $category->id]) }}" class="btn btn-link">Editar</a>
                                    </li>
                                </ul>
                                   <ul>
                                    <li>
                                    <a href="{{ route('categories.edit',['category' => $category->id]) }}" class="btn btn-link"
                                        onclick="event.preventDefault();document.getElementById('delete-form-item-{{$category->id}}').submit()">Deletar</a>
                                        {!! Form::open(['route' => ['categories.destroy','category' => $category->id],'method' => 'delete','id' => "delete-form-item-{$category->id}",'style' =>'display:none']) !!}
                                            {!! Form::submit('Excluir',['class' => 'btn btn-link']) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                               
                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>

@endsection