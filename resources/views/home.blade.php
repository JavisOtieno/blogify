@extends('layouts.master')

@section('content')
  <div class="p-4">
    <h1>Welcome to Blogify</h1>
    @auth
      <p>Hello, {{ auth()->user()->name }} — View <a @class(['active' => request()->routeIs('posts.*')]) href="{{ route('posts.index') }}">Posts</a>.</p>
    @else
      <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>.</p>
    @endauth
  </div>
@endsection