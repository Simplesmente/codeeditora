@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Livro</h3>   
          
            {!! Form::open(['route' => 'books.store','class' => 'form']) !!}

                {!! Html::openFormGroup('title',$errors) !!}

                    {!! Form::Label('title', 'Título') !!}
                    {!! Form::Text('title',null, ['class' => 'form-control']) !!} 
                    {!! Form::error('title',$errors) !!}

                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('subtitle',$errors) !!}
                    {!! Form::Label('subtitle', 'Subtítulo') !!}
                    {!! Form::Text('subtitle',null, ['class' => 'form-control']) !!} 
                    {!! Form::error('subtitle',$errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('price',$errors) !!}
                    {!! Form::Label('price', 'Preço') !!}
                    {!! Form::Text('price',null, ['class' => 'form-control']) !!}
                    {!! Form::error('price',$errors) !!} 
                {!! Html::closeFormGroup() !!}  

                <div class="form-group">
                    {!! Form::submit('Cria Livro',['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
