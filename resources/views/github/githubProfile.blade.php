@extends('layouts.app')
@section('content')
    @if($result)

      {!! Html::image($result->avatar_url,'alt', array( 'width' => 70, 'height' => 70 )) !!}
      <ul>
          <li>
              <p>Name: {!! $result->name !!}</p></li>
          <li>
              <p>Company: {!! $result->company !!}</p></li>
          <li>
              <p>Blog: {!! $result->blog !!}</p></li>
          <li>
              <p>Email: {!! $result->email !!}</p></li>
          <li>
              <p>Followers: {!! $result->followers !!}</p></li>
      </ul>
    @else
        <p>Sorry,{!! $name !!}} is not found.</p>
    @endif
    @endsection