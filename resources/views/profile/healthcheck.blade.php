<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logos/logo-brand.png') }}">
    <title>Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sidebar and Main Content Flex Layout */
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            margin: 0;
        }

        #app-container {
            display: flex;
            flex: 1; /* Main flex container for sidebar and content */
        }

        #sidebar {
            width: 215px;
            flex-shrink: 0; /* Prevent sidebar from shrinking */
            background-color: #f8f9fa; /* Sidebar background */
            border-right: 1px solid #dee2e6;
            position: sticky;
            top: 0; /* Sidebar sticks to the top */
            height: 100vh; /* Full height for sidebar */
        }

        #main-content {
            flex: 1; /* Allow content to expand */
            padding: 16px;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            #sidebar {
                width: 100%; /* Sidebar takes full width on small screens */
                height: auto; /* Height adjusts based on content */
                position: relative; /* Non-fixed for mobile */
            }

            #main-content {
                margin-left: 0; /* Remove margin for main content */
            }
        }
    </style>
</head>
<body>

    <div id="app-container">
        <!-- Sidebar -->
        <div id="sidebar">
            @include('profile.partials.sidebar')
        </div>

        <!-- Main Content -->
        <div id="main-content">
            <div class="card shadow-sm">
                <div class="card-body">
                   <h1 class="mb-4">ข้อมูลการตรวจสุขภาพ</h1>

                    @if ($healthChecks->count() > 0)
                        <div class="accordion" id="healthCheckAccordion">
                            @foreach ($healthChecks as $index => $check)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $index }}" 
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                                aria-controls="collapse{{ $index }}">
                                            การตรวจสุขภาพครั้งที่ {{ $index + 1 }} - {{ $check->check_date }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" 
                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                        aria-labelledby="heading{{ $index }}" 
                                        data-bs-parent="#healthCheckAccordion">
                                        <div class="accordion-body">
                                            <p><strong>วันที่ตรวจ:</strong> {{ $check->check_date }}</p>
                                            <p><strong>ความดันตัวบน (SBP):</strong> {{ $check->blood_pressure_sbp ?? 'N/A' }} mmHg</p>
                                            <p><strong>ความดันตัวล่าง (DBP):</strong> {{ $check->blood_pressure_dbp ?? 'N/A' }} mmHg</p>
                                            <p><strong>ระดับน้ำตาลในเลือด (FPG):</strong> {{ $check->fpg ?? 'N/A' }} mg/dL</p>
                                            <p><strong>หมายเหตุ:</strong> {{ $check->blood_test_results ?? 'ไม่มีข้อมูลเพิ่มเติม' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">ยังไม่มีข้อมูลการตรวจสุขภาพ</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

