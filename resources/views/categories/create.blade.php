@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>   
           
            {!! Form::open(['route' => 'categories.store','class' => 'form']) !!}

            <div class="form-group">
                {!! Form::Label('name', 'Nome') !!}
                {!! Form::Text('name',null, ['class' => 'form-control']) !!} 
            </div>

            <div class="form-group">
                {!! Form::submit('Cria categoria',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection