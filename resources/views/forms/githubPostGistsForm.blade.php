    @if(\Session::has('message'))
        <div><p>{{\Session::get('message')}}</p></div>
        @endif
    {!! Form::open(['url' => '/githubpostgists', 'method' => 'post']) !!}
    <div class="form-group row">
        <div class="col-md-2">
            {!! Form::label('filename','File Name:') !!}
        </div>
        <div class="col-md-6">
            {!! Form::text('filename',null,['placeholder'=>'Please enter file name','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
            {!! Form::label('code','Code:') !!}
        </div>
        <div class="col-md-6">
            {!! Form::textarea('code',null,['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
    <div class="g-recaptcha col-md-6 col-md-offset-2" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 col-md-offset-2">
            {!! Form::submit('Gist',['class'=>'form-control']) !!}
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

