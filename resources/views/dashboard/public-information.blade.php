@extends('layouts.dashboard')

@section('content')
<div class="container-fluid my-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-file-earmark-text me-2"></i>Public Information (Posts)
        </h2>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('dashboard.public-information') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search posts by title or content..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>

    <!-- Posts Table -->
    <div class="table-responsive rounded shadow-sm">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Content</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td class="text-center">{{ $post->id }}</td>
                        <td class="fw-semibold">{{ $post->title }}</td>
                        <td>{!! Str::limit($post->content, 50, '...') !!}</td>
                        <td class="text-center">{{ $post->author->name ?? 'Unknown' }}</td>
                        <td class="text-center">{{ $post->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            <span class="badge bg-success">Available</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            <i class="bi bi-info-circle me-2"></i>No posts available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-muted small mb-0">
            Showing {{ $posts->firstItem() ?? 0 }} to {{ $posts->lastItem() ?? 0 }} of {{ $posts->total() ?? 0 }} posts
        </p>
        <div>
            {{ $posts->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
