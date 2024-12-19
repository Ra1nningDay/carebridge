<!-- resources/views/dashboard/header.blade.php -->
<header class="d-flex justify-content-between align-items-center py-3 px-4 border-bottom sticky-top" style="background-color: #f8f9fc;">
    <!-- Sidebar Toggle Button -->
    <button id="sidebarToggle" class="btn btn-light me-3" aria-label="Toggle Sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Search Bar -->
    <div class="input-group w-50">
        <span class="input-group-text bg-white border-0" id="search-icon">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control border-0" placeholder="Search your task, etc..." aria-label="Search" aria-describedby="search-icon">
    </div>

    <!-- User Profile -->
    <div class="d-flex align-items-center">
        <div class="me-3 text-end">
            <h6 class="mb-0">{{ auth()->user()->name ?? 'Guest' }}</h6>
            <small class="text-muted">{{ auth()->user()->role ?? 'Project Manager' }}</small> <!-- Assuming 'role' field exists -->
        </div>
        <img src="{{ asset('images/user.png') }}" alt="User Avatar" class="rounded-circle" width="40" height="40">
    </div>
</header>
