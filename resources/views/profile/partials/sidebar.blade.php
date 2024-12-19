<div class="d-none d-md-flex flex-column p-3 bg-light border-end"
     id="sidebar"
     style="position: fixed; height: 100vh; width: 215px; z-index: 1000;">
     
    <a class="navbar-brand d-flex align-items-center text-black fs-4 logo-animation" href="{{ route('welcome') }}">
        <img src="{{ asset('images/logos/logo-brand.png') }}" width="40" height="40" alt="โลโก้แบรนด์" class="img-fluid">
        <span class="fw-bold ps-1" style="font-size: 26px; color: #003e29;">CareBridge</span>
    </a>
    
    <ul class="nav nav-pills flex-column mt-3 mb-auto">
        <li class="nav-item">
            <h5 class="border-bottom pb-2">Personal Profile</h5>
        </li>
        <!-- Profile -->
        <li class="nav-item mb-3">
            <a href="{{ route('profile.index') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('profile/view') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-person-circle me-2"></i>
                Profile
            </a>
        </li>
        
        <!-- Edit Profile -->
        <li class="nav-item mb-3">
            <a href="{{ route('profile.edit') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('profile/edit') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Profile
            </a>
        </li>

        <!-- Edit Profile -->
        <li class="nav-item mb-3">
            <a href="{{ route('healthcheck.show') }}" 
               class="nav-link d-flex align-items-center {{ request()->is('profile/healthcheck') ? 'active bg-primary text-white' : 'text-dark' }}">
                <i class="bi bi-pencil-square me-2"></i>
                Health Check
            </a>
        </li>

        

        
        <!-- Edit Caregiver -->
        @if (auth()->user()->caregiver)
            <li class="nav-item">
                <h5 class="border-bottom pb-2">Caregiver Profile</h5>
            </li>
            <li class="nav-item mb-3">
                <a href="{{ route('caregiver.edit') }}" 
                    class="nav-link d-flex align-items-center {{ request()->is('caregiver/edit') ? 'active bg-primary text-white' : 'text-dark' }}">
                    <i class="bi bi-heart me-2"></i>
                    Edit Caregiver
                </a>
            </li>
        @endif
    </ul>

    <footer class="mt-auto text-center">
        <p class="small text-muted">&copy; 2024 CareBridge</p>
    </footer>
</div>

<!-- Sidebar สำหรับจอเล็ก -->
<div class="d-md-none">
    <button class="btn btn-primary m-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        Menu
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Navigation</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item mb-3">
                    <a href="{{ route('profile.index') }}" 
                       class="nav-link d-flex align-items-center {{ request()->is('profile/view') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="bi bi-person-circle me-2"></i>
                        Profile
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{ route('profile.edit') }}" 
                       class="nav-link d-flex align-items-center {{ request()->is('profile/edit') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Profile
                    </a>
                </li>
            @if (auth()->user()->caregiver)
                <li class="nav-item mb-3">
                    <a href="{{ route('caregiver.edit') }}" 
                        class="nav-link d-flex align-items-center {{ request()->is('caregiver/edit') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="bi bi-heart me-2"></i>
                        Edit Caregiver
                    </a>
                </li>
            @endif
            </ul>
        </div>
    </div>
</div>

<style>
    #sidebar {
    transition: width 0.3s ease-in-out;
}

@media (max-width: 768px) {
    #sidebar {
        display: none;
    }

    .offcanvas {
        width: 75%;
    }

    .offcanvas-body {
        padding: 1rem;
    }
}

</style>
