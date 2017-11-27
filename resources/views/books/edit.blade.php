@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>   
           
            {!! Form::model( $book,[
                                'route' => ['books.update',
                                'book' => $book->id],
                                'class' => 'form',
                                'method' => 'PUT'
                            ]) !!}

            <div class="form-group">
                {!! Form::Label('title', 'Título') !!}
                {!! Form::Text('title',null, ['class' => 'form-control']) !!} 
            </div>

            <div class="form-group">
                {!! Form::Label('subtitle', 'Subtítulo') !!}
                {!! Form::Text('subtitle',null, ['class' => 'form-control']) !!} 
            </div>


            <div class="form-group">
                {!! Form::Label('price', 'Preço') !!}
                {!! Form::Text('price',null, ['class' => 'form-control']) !!} 
            </div>


            <div class="form-group">
                {!! Form::submit('Salvar livro',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection