@extends('layouts.app')

@section('title', 'CareBridge - พื้นที่ของคุณสำหรับผู้สูงอายุในไทย')

@section('content')
        @include('home_partials.carousel')

        {{-- Service Section --}}
        @include('home_partials.services')

        {{-- Find Caregiver Section --}}
        @include('home_partials.find_caregiver')

        {{-- About Us Section --}}
        @include('home_partials.about_us')
        
        {{-- Caregiver Section--}}
        @include('home_partials.caregiver_list')

        <!-- Latest Stories Section -->
        @include('home_partials.lastest_stories')

        {{-- Evaluation Form Section --}}
        @include('home_partials.evaluation')

         <!-- Contact Section -->
        @include('home_partials.contact_us')

        

        {{-- Evaluation Topics
        @include('home_partials.rating') --}}

    </div>  
    @include('layouts.footer')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        fetch("{{ route('visit.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({})
        }).then(response => {
            if (!response.ok) {
                console.error('Failed to record visit');
            }
        }).catch(error => console.error('Error:', error));
    });

    document.addEventListener('DOMContentLoaded', function () {
        const toastElements = document.querySelectorAll('.toast');
        toastElements.forEach(function (toastElement) {
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        });
    });

</script>