@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar categoria</h3>

            @include('codeedubook::errors._errors_field')

            {!! Form::model($category, ['route' => ['categories.update', 'category' => $category->id], 'class' => 'form', 'method' => 'PUT']) !!}

                @include('codeedubook::categories._form')

                {!! Html::openFormGroup('name', $errors) !!}
                    {{--{!! Form::submit('Salvar categoria', ['class' => 'btn btn-primary']) !!}--}}
                    {!! Button::primary('Salvar categoria')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
