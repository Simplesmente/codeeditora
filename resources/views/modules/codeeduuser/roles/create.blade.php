@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Role</h3>   
            
            {!! Form::open(['route' => 'codeeduuser.roles.store','class' => 'form']) !!}
                
                {!! Form::hidden('redirect_to',URL::previous()) !!}

                @include('codeeduuser::roles._form')

              
            

            <div class="form-group">
                <!-- {!! Form::submit('Cria categoria',['class' => 'btn btn-primary']) !!} -->
                {!! Button::primary('Criar')->submit() !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection