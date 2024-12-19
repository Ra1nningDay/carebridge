@extends('layouts.dashboard')

@section('content')
<div class="container-fluid mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Caregiver Applications</h2>
        
        <!-- Search Bar -->
        <form action="{{ route('dashboard.caregiver-management') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by User ID or Specialization" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Caregiver Applications Table -->
    <div class="table-responsive rounded shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Specialization</th>
                    <th>Experience (Years)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($caregivers as $caregiver)
                    <tr>
                        <td class="text-center">{{ $caregiver->id }}</td>
                        <td class="text-center">{{ $caregiver->user_id }}</td>
                        <td>{{ $caregiver->specialization }}</td>
                        <td class="text-center">{{ $caregiver->experience_years }}</td>
                        <td class="text-center">
                            <span class="badge 
                                {{ $caregiver->status == 'Pending' ? 'bg-warning text-dark' : '' }}
                                {{ $caregiver->status == 'Approved' ? 'bg-success' : '' }}
                                {{ $caregiver->status == 'Rejected' ? 'bg-danger' : '' }}">
                                {{ $caregiver->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('caregivers.updateStatus', $caregiver->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm" required>
                                    <option value="Pending" {{ $caregiver->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ $caregiver->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Rejected" {{ $caregiver->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-check-circle"></i> Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No caregivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-muted small mb-0">
            Showing {{ $caregivers->firstItem() }} to {{ $caregivers->lastItem() }} of {{ $caregivers->total() }} caregivers
        </p>
        <div>
            {{ $caregivers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
