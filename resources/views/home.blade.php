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
                  @include('forms.githubSearchForm')
                    <h2>Github gists</h2>
                    @include('forms.githubPostGistsForm')
                    <h2>Facebook share</h2>
                    @include('forms.facebookshare')

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
