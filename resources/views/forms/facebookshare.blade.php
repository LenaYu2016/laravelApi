@if(\Session::has('message'))
    <div><p>{{\Session::get('message')}}</p></div>
@endif
{!! Form::open() !!}
<div class="form-group row">
    <div class="col-md-2">
        {!! Form::label('link','Link:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('link',null,['placeholder'=>'Please enter link','class'=>'form-control ']) !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4 col-md-offset-2">
        <a>
        {!! Form::button('Share',['class'=>'form-control btn btn-success clearfix','id'=>"shareBtn"]) !!}
        </a>
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

