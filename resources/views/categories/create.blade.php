@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Categoria</h3>   
            
            {!! Form::open(['route' => 'categories.store','class' => 'form']) !!}

                {!! Html::openFormGroup('name',$errors) !!}

                    {!! Form::Label('name', 'Nome',['class' => 'control-label']) !!}
                    {!! Form::Text('name',null, ['class' => 'form-control']) !!} 
                    
                    {!! Form::error('name',$errors) !!}
                
                {!! Html::closeFormGroup() !!}
            

            <div class="form-group">
                {!! Form::submit('Cria categoria',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection