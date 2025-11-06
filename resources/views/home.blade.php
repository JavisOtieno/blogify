@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Welcome, {{ Auth::user()->name ?? 'Guest' }}!</h1>
    <p>This is your Home page.</p>
</div>
@endsection