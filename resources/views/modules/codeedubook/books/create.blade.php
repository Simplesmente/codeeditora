@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo livro</h3>

            {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

                @include('books._form')

                {!! Html::openFormGroup() !!}
                    {{--{!! Form::submit('Cadastrar livro', ['class' => 'btn btn-primary']) !!}--}}
                    {!! Button::primary('Cadastrar livro')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
