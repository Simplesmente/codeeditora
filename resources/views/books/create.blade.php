@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Livro</h3>   
           
            {!! Form::open(['route' => 'books.store','class' => 'form']) !!}

            <div class="form-group">
                {!! Form::Label('title', 'Título') !!}
                {!! Form::Text('title',null, ['class' => 'form-control']) !!} 
            </div>
            
            <div class="form-group">
                {!! Form::Label('subtitle', 'Subtitulo') !!}
                {!! Form::Text('subtitle',null, ['class' => 'form-control']) !!} 
            </div>

            <div class="form-group">
                {!! Form::Label('price', 'Preço') !!}
                {!! Form::Text('price',null, ['class' => 'form-control']) !!} 
            </div>

            <div class="form-group">
                {!! Form::submit('Cria Livro',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
