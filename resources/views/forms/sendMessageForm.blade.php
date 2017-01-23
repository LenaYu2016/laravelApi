@if(\Session::has('suceess'))
    <div><p>{{\Session::get('suceess')}}</p></div>
@endif
{!! Form::open(['url' => '/send', 'method' => 'post']) !!}
<div class="form-group row">
    <div class="col-md-2">
        {!! Form::label('number','Your sender ID:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('number',null,['placeholder'=>'Please enter sender ID','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-2">
        {!! Form::label('to','Send to:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('to',null,['placeholder'=>'Send to','class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-2">
        {!! Form::label('text','Message:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::textarea('text',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Send',['class'=>'form-control']) !!}
    </div>
</div>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
{!! Form::close() !!}

