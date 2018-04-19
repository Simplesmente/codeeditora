{!! Html::openFormGroup('title', $errors) !!}
    {!! Form::hidden('redirect_to', URL::previous()) !!}
    {!! Form::label('title', 'Título', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! Form::error('title', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('subtitle', $errors) !!}
    {!! Form::label('subtitle', 'Subtitulo', ['class' => 'control-label']) !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    {!! Form::error('subtitle', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('price', $errors) !!}
    {!! Form::label('price', 'Preço', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
    {!! Form::error('price', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['categorias','categorias.*'], $errors) !!}
    {!! Form::label('categorias[]', 'Categorias', ['class' => 'control-label']) !!}
    {!! Form::select('categorias[]', $categorias, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
    {!! Form::error('categorias', $errors) !!}
    {!! Form::error('categorias.*', $errors) !!}
{!! Html::closeFormGroup() !!}
