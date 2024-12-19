@extends('layouts.dashboard')

@section('content')
<div class="container-fluid mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-people-fill me-2"></i>User Management
        </h2>
        <button class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Add User
        </button>
    </div>

    <!-- Tabs for Tables -->
    <ul class="nav nav-tabs mb-4" id="userManagementTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">
                <i class="bi bi-person-lines-fill me-1"></i>Users
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="false">
                <i class="bi bi-shield-lock me-1"></i>Roles
            </button>
        </li>
    </ul>

    <div class="tab-content" id="userManagementTabsContent">
        <!-- Users Table -->
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Verified At</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>{{ $user->email_verified_at->format('Y-m-d H:i') }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i> Not Verified
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $user->roles->pluck('name')->join(', ') }}</td>
                                <td class="text-center">
                                    @if ($user->status === 'active')
                                        <span class="badge bg-primary">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Edit User">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete User">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    <i class="bi bi-info-circle me-2"></i>No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <p class="text-muted small mb-0">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }} users
                    </p>
                    <div>
                        {{ $users->appends(request()->except('users_page'))->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td class="text-center">{{ $role->id }}</td>
                                <td class="fw-semibold">{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td class="text-center">{{ $role->created_at }}</td>
                                <td class="text-center">{{ $role->updated_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i class="bi bi-info-circle me-2"></i>No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
