@extends('layouts.carefield')

@section('title', 'CareField')

@section('content')
<div class="container-fluid my-3 mx-2">

    <!-- Breadcrumb -->
    @include('carefield.partials.breadcrumb')

    <h1 class="mb-4">ข้อมูลสุรป</h1>

    <!-- Section: Overview Statistics -->
    <div class="row g-4">
        <!-- Card: Total Patients -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-container bg-primary text-white rounded-circle me-3">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 text-primary">จำนวนผู้รับการตรวจทั้งหมด</h5>
                        <p class="fs-4 mb-0"><strong>{{ $totalPatients }}</strong> คน</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Health Checks Recorded -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-container bg-success text-white rounded-circle me-3">
                        <i class="fas fa-notes-medical fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 text-success">การตรวจสุขภาพที่บันทึก</h5>
                        <p class="fs-4 mb-0"><strong>{{ $totalHealthChecks }}</strong> รายการ</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Male Patients -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-container bg-info text-white rounded-circle me-3">
                        <i class="fas fa-male fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 text-info">ผู้ป่วยชาย</h5>
                        <p class="fs-4 mb-0"><strong>{{ $malePatients }}</strong> คน</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Female Patients -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center">
                    <div class="icon-container bg-danger text-white rounded-circle me-3">
                        <i class="fas fa-female fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0 text-danger">ผู้ป่วยหญิง</h5>
                        <p class="fs-4 mb-0"><strong>{{ $femalePatients }}</strong> คน</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Overview Chart -->
    <div class="mt-5">
        <div class="card shadow-sm p-4">
            <h5 class="text-primary mb-3"><i class="fas fa-chart-pie"></i> ภาพรวมสถิติ</h5>
            <div class="chart-container">
                <!-- Placeholder for Chart -->
                <div class="skeleton-box" style="width: 100%; height: 300px;"></div>
            </div>
        </div>
    </div>

    <!-- Section: Recent Activity -->
    <div class="mt-5">
        <div class="card shadow-sm p-4">
            <h5 class="text-primary mb-3"><i class="fas fa-clipboard-list"></i> กิจกรรมล่าสุด</h5>
            <ul class="list-group">
                @forelse ($recentActivities as $activity)
                    <li class="list-group-item">
                        {{ $activity['message'] }} <span class="text-muted">{{ $activity['time'] }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">ไม่มีข้อมูลกิจกรรม</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

<!-- Additional CSS -->
<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0.5rem;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #0056b3;
    }
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .breadcrumb-item.active {
        color: #6c757d;
    }

    .icon-container {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        border-radius: 10px;
    }

    .card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .list-group-item {
        border: none;
        padding: 15px 20px;
        font-size: 16px;
    }

    .list-group-item:not(:last-child) {
        border-bottom: 1px solid #e0e0e0;
    }

    .skeleton-box {
        background-color: #e0e0e0;
        border-radius: 5px;
        animation: skeleton-loading 1.5s infinite;
    }

    @keyframes skeleton-loading {
        0% {
            background-color: #e0e0e0;
        }
        50% {
            background-color: #f0f0f0;
        }
        100% {
            background-color: #e0e0e0;
        }
    }
</style>
