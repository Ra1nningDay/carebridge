@extends('layouts.dashboard')

@section('content')
<div class="container-fluid mt-5">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-star-fill me-2"></i>Ratings Management
        </h2>
        <a href="{{ route('ratings.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </a>
    </div>

    <!-- Total Stars -->
    <div class="mt-4">
        <h4 class="fw-bold text-secondary">
            <i class="bi bi-star-fill text-warning me-2"></i>Total Stars Across All Topics: 
            <span class="text-primary">{{ $totalStars }}</span>
        </h4>
    </div>

    <!-- Ratings Table -->
    <div class="table-responsive rounded shadow-sm mt-4">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Topic</th>
                    <th>Total Stars</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ratings as $rating)
                    <tr>
                        <td class="text-center fw-semibold">
                            <i class="bi bi-bookmark-fill text-success me-1"></i>{{ $rating->title }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark px-3 py-2">
                                <i class="bi bi-star-fill"></i> {{ $rating->total_stars }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            <i class="bi bi-info-circle-fill me-2"></i>No ratings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
