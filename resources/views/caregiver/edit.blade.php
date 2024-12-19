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
                    <section class="mb-5">
                        <header class="mb-3">
                            <h2 class="h5 text-primary fw-bold">Edit Caregiver Profile</h2>
                            <p class="text-muted">Update your caregiver profile information to provide accurate and helpful details.</p>
                        </header>

                        <form action="{{ route('caregiver.update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')

                            <!-- Specialization -->
                            <div class="mb-4">
                                <label for="specialization" class="form-label fw-semibold">Specialization</label>
                                <input type="text" class="form-control px-3 py-2" id="specialization" name="specialization" value="{{ $caregiver->specialization }}" required>
                                @error('specialization')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Experience -->
                            <div class="mb-4">
                                <label for="experience_years" class="form-label fw-semibold">Experience (Years)</label>
                                <input type="number" class="form-control px-3 py-2" id="experience_years" name="experience_years" value="{{ $caregiver->experience_years }}" required>
                                @error('experience_years')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="latitude" class="form-label fw-semibold">Latitude</label>
                                    <input type="text" class="form-control px-3 py-2" id="latitude" name="latitude" value="{{ $caregiver->latitude }}" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="longitude" class="form-label fw-semibold">Longitude</label>
                                    <input type="text" class="form-control px-3 py-2" id="longitude" name="longitude" value="{{ $caregiver->longitude }}" readonly>
                                </div>
                            </div>

                            <!-- Update Location Button -->
                            <div class="d-flex justify-content-center mb-4">
                                <button type="button" id="update-location-btn" class="btn btn-success btn-lg">
                                    <i class="bi bi-geo-alt-fill me-2"></i>Update Location
                                </button>
                            </div>

                            <!-- Map Preview -->
                            <div class="mb-4">
                                <iframe 
                                    id="map-preview" 
                                    width="100%" 
                                    height="400" 
                                    frameborder="0" 
                                    class="rounded"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyC9jFNX78kT7vUPMaWDcxTYCFMT1XgWdGs&q={{ $caregiver->latitude ?? 13.736717 }},{{ $caregiver->longitude ?? 100.523186 }}">
                                </iframe>
                            </div>

                            <!-- Save Changes Button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9jFNX78kT7vUPMaWDcxTYCFMT1XgWdGs&callback=initMap" async defer></script>
    <script>
        let map, marker;

        function initMap() {
            const initialPosition = {
                lat: {{ $caregiver->latitude ?? 13.736717 }},
                lng: {{ $caregiver->longitude ?? 100.523186 }}
            };

            map = new google.maps.Map(document.getElementById('map-preview'), {
                center: initialPosition,
                zoom: 15,
            });

            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(marker, 'dragend', function () {
                const position = marker.getPosition();
                document.getElementById('latitude').value = position.lat();
                document.getElementById('longitude').value = position.lng();
            });
        }

        document.getElementById('update-location-btn').addEventListener('click', () => {
            const position = marker.getPosition();
            document.getElementById('latitude').value = position.lat();
            document.getElementById('longitude').value = position.lng();
            alert("Location updated successfully!");
        });
    </script>
</body>
</html>
