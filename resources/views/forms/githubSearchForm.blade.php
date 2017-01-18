@extends('./home')
@section('githubform')
{!! Form::open(array('url' => '/handlegithub', 'method' => 'post')) !!}
<div class="form-group row">
    <div class="col-md-4">
{!! Form::label('name','Name:') !!}
    </div>
    <div class="col-md-6">
{!! Form::text('name',null,['placeholder'=>'Please enter name','class'=>['form-control']]) !!}
        </div>
</div>
<div class="form-group">
{!! Form::sumit('Search',['class'=>['form-control']]) !!}
</div>
    {!! Form::close() !!}
@stop