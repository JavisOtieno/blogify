@extends('layouts.master')

@section('content')
<div class="container py-4">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to posts</a>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="text-muted mb-1">
                Source: <strong>{{ $post->source }}</strong> |
                External ID: <strong>{{ $post->external_id }}</strong> |
                Status: <strong>{{ $post->status }}</strong>
            </p>
            <hr>
            <div class="post-content">
                {{-- If content contains newlines, preserve them --}}
                {!! nl2br(e($post->content)) !!}
            </div>

            <hr>
            <p class="small text-muted mb-0">Created: {{ $post->created_at->toDayDateTimeString() }}</p>
            <p class="small text-muted">Updated: {{
