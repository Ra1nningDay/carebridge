<nav id="sidebarMenu" class="col-lg-2 col-md-3 bg-light sidebar sticky-top" style="background-color: #f8f9fc; height: 100vh; padding: 20px; overflow-y: auto; height: 100vh;">
    <div class="position-sticky">
        <!-- Logo and Brand Name -->
        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('images/logos/logo-brand.png') }}" alt="Logo" width="40" height="40" class="me-2">
            <span class="fs-4 fw-bold text-primary">CareBridge</span>
        </div>

        <!-- Navigation Links -->
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active bg-primary text-white' : 'text-dark' }} p-3 w-100" 
                   href="{{route('dashboard')}}" 
                   style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-speedometer2 me-3" style="font-size: 1.2rem;"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- User Management -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard.user-management') ? 'active bg-primary text-white' : 'text-dark' }} p-3 w-100" 
                   href="{{route('dashboard.user-management')}}" 
                   style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-folder me-3" style="font-size: 1.2rem;"></i>
                    <span>User Management</span>
                </a>
            </li>

            <!-- Public Information -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center text-dark p-3 w-100 {{ request()->routeIs('dashboard.public-information') ? 'active bg-primary text-white' : 'text-dark'}}" href="{{ route('dashboard.public-information') }}" style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-list me-3" style="font-size: 1.2rem;"></i>
                    <span>Public Information</span>
                </a>
            </li>

            <!-- Evaluation System -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('evaluations.index', 'ratings.index') ? 'active bg-primary text-white' : 'text-dark' }} p-3 w-100" 
                   data-bs-toggle="collapse" 
                   href="#evaluationMenu" 
                   role="button" 
                   aria-expanded="{{ request()->routeIs('evaluations.index', 'ratings.index') ? 'true' : 'false' }}" 
                   aria-controls="evaluationMenu" 
                   style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-clipboard-data me-3" style="font-size: 1.2rem;"></i>
                    <span>Evaluation System</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->routeIs('evaluations.index', 'ratings.index') ? 'show' : '' }}" id="evaluationMenu">
                    <ul class="list-unstyled ps-4">
                        <li class="mb-2">
                            <a class="nav-link {{ request()->routeIs('evaluations.index') ? 'text-primary fw-bold' : 'text-dark' }}" href="{{ route('evaluations.index') }}" style="font-size: 0.9rem;">
                                <i class="bi bi-graph-up-arrow me-2" style="font-size: 1.1rem;"></i>
                                View Evaluations
                            </a>
                        </li>
                        <li>
                            <a class="nav-link {{ request()->routeIs('ratings.index') ? 'text-warning fw-bold' : 'text-dark' }}" href="{{ route('ratings.index') }}" style="font-size: 0.9rem;">
                                <i class="bi bi-star me-2" style="font-size: 1.1rem;"></i>
                                Rating System
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Caregiver Overview -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard.caregiver-management') ? 'active bg-primary text-white' : 'text-dark' }} p-3 w-100" 
                   href="{{ route('dashboard.caregiver-management') }}" 
                   style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-people me-3" style="font-size: 1.2rem;"></i>
                    <span>Caregiver Overview</span>
                </a>
            </li>

            <!-- Assessments -->
            <li class="nav-item ">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('survey.index') ? 'active bg-primary text-white' : 'text-dark' }} p-3 w-100" 
                   data-bs-toggle="collapse" 
                   href="#assessmentsCollapse" 
                   role="button" 
                   aria-expanded="{{ request()->routeIs('survey.index') ? 'true' : 'false' }}" 
                   aria-controls="assessmentsCollapse" 
                   style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-clipboard-check me-3" style="font-size: 1.2rem;"></i>
                    <span>Assessments</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->routeIs('survey.index') ? 'show' : '' }}" id="assessmentsCollapse">
                    <ul class="list-unstyled ps-4">
                        <li class="mb-2">
                            <a class="nav-link text-dark text-decoration-none" href="{{ route('survey.index') }}">
                                View Assessments
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="nav-link text-dark text-decoration-none" href="#">
                                View Submitted Survey
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <!-- Settings -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center text-dark p-3 w-100" href="#" style="font-size: 1rem; border-radius: 8px;">
                    <i class="bi bi-gear me-3" style="font-size: 1.2rem;"></i>
                    <span>Settings</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
