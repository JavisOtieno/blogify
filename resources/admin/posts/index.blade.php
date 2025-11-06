@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.posts.import') }}" method="POST" class="mb-3">
        @csrf
        <select name="source" required>
            <option value="jsonplaceholder">JSONPlaceholder</option>
            <option value="fakestore">FakeStore</option>
        </select>
        <button class="btn btn-primary">Import single item</button>
    </form>

    <table class="table">
        <thead><tr><th>ID</th><th>Title</th><th>Source</th><th>External ID</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($posts as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($p->title, 80) }}</td>
                    <td>{{ $p->source }}</td>
                    <td>{{ $p->external_id }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <a href="{{ route('admin.posts.show', $p) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('admin.posts.edit', $p) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $p) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
