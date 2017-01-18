@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <h2>Github profile Search</h2>
                    {!! Form::open(['url' => '/handlegithub', 'method' => 'post']) !!}
                    <div class="form-group row">
                        <div class="col-md-4">
                            {!! Form::label('name','Name:') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('name',null,['placeholder'=>'Please enter name','class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Search',['class'=>['form-control']]) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
