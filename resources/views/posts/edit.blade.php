@extends('layouts.master')

@section('content')
<div class="container py-4">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to posts</a>

    <div class="card">
        <div class="card-body">
            <h3>Edit Post</h3>

            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                    @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="8" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                    @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Source (read-only)</label>
                    <input class="form-control" value="{{ $post->source }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">External ID (read-only)</label>
                    <input class="form-control" value="{{ $post->external_id }}" readonly>
                </div>

                <button class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
