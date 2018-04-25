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
                
                {!! Form::hidden('redirect_to',URL::previous()) !!}
                
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

                {!! Html::openFormGroup('categories',$errors) !!}
                    {!! Form::Label('categories[]', 'Categorias') !!}
                    {!! Form::select('categories[]',$categories,null, ['class' => 'form-control','multiple' =>true]) !!} 
                    {!! Form::error('categories',$errors) !!}
                    {!! Form::error('categories.*',$errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('price',$errors) !!}
                    {!! Form::Label('price', 'Preço') !!}
                    {!! Form::Text('price',null, ['class' => 'form-control']) !!} 
                    {!! Form::error('price',$errors) !!}
                {!! Html::closeFormGroup() !!}


            <div class="form-group">
                {!! Form::submit('Salvar livro',['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection