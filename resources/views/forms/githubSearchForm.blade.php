
    {!! Form::open(['url' => '/handlegithub', 'method' => 'post']) !!}
    <div class="form-group row">
        <div class="col-md-2">
            {!! Form::label('name','Name:') !!}
        </div>
        <div class="col-md-6">
            {!! Form::text('name',null,['placeholder'=>'Please enter name','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 col-md-offset-2">
            {!! Form::submit('Search',['class'=>'form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
