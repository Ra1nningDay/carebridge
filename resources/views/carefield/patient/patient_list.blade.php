@extends('layouts.carefield')

@section('title', 'CareField')

@section('content')
<div class="container-fluid my-3 mx-2">
    <!-- Breadcrumb -->
    @include('carefield.partials.breadcrumb')

    <h1 class="mb-4">รายชื่อผู้รับการตรวจสุขภาพ</h1>
    <!-- Section: เครื่องมือค้นหา -->
    @include('carefield.patient.partials.search')

    <!-- รายชื่อผู้ป่วย -->
    <div class="row g-4">
        @forelse ($users as $user)
        
        {{-- Card: ผู้สูงอายุ --}}
        @include('carefield.patient.partials.patient_card')

        @empty
        <p class="text-center text-muted">ไม่มีข้อมูลผู้ป่วย</p>
        @endforelse
    </div>
</div>
@endsection



<style>
    /* การตกแต่งการ์ดผู้ป่วย */
    .patient-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .patient-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .patient-card-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .patient-card img {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
    
</style>
