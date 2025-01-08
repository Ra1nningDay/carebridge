<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logos/logo-brand.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom CSS for sidebar toggle effect */
        .sidebar-collapsed {
            display: none;
        }

        #sidebarMenu {
            transition: all 0.3s;
        }

        /* Adjust main content when sidebar is collapsed */
        .main-expanded {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar with ID for JavaScript targeting -->
            @include('dashboard.partials.sidebar')

            <!-- Main Content Area with Header -->
            <div id="mainContent" class="col-md-9 col-lg-10 p-0">
                @include('dashboard.partials.header')
                <main class="ms-sm-auto px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebarMenu');
            const mainContent = document.getElementById('mainContent');

            // Toggle the sidebar visibility
            sidebar.classList.toggle('sidebar-collapsed');

            // Adjust main content width
            mainContent.classList.toggle('main-expanded');
        });
    </script>
</body>
</html>
