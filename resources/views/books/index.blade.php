@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de Livros</h3>   
            <a href="{{ route('books.create') }}" class="btn btn-primary">Novo Livro</a>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th> 
                        <th>Subtitulo</th> 
                        <th>Preço</th> 
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->subtitle }}</td>
                            <td>R$ {{ $book->price }}</td>
                            <td>
                                <ul>
                                    <li> 
                                        <a href="{{ route('books.edit',['book' => $book->id]) }}" class="btn btn-link">Editar</a>
                                    </li>
                                </ul>
                                   <ul>
                                    <li>
                                    <a href="{{ route('books.destroy',['book' => $book->id]) }}" class="btn btn-link"
                                        onclick="event.preventDefault();document.getElementById('delete-form-item-{{$book->id}}').submit()">Deletar</a>
                                        {!! Form::open(['route' => ['books.destroy','category' => $book->id],'method' => 'delete','id' => "delete-form-item-{$book->id}",'style' =>'display:none']) !!}
                                            {!! Form::submit('Excluir',['class' => 'btn btn-link']) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                               
                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $books->links() }}
        </div>
    </div>

@endsection