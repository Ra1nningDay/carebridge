@extends('layouts.dashboard')

@section('content')
<div class="container-fluid my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-bar-chart me-2"></i>Dashboard
        </h2>
    </div>
    <section class="row">
        <!-- User Statistics Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">สถิติผู้ใช้งาน</h5>
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: #467061;"></i>
                    </div>
                    <h2 class="card-text text-center text-success">{{ $userCount }}</h2>
                    <p class="text-muted text-center">ผู้ใช้งานทั้งหมด</p>
                </div>
            </div>
        </div>

        <!-- Post Count Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">จำนวนกระทู้</h5>
                        <i class="bi bi-file-earmark-post" style="font-size: 2rem; color: #467061;"></i>
                    </div>
                    <h2 class="card-text text-center text-warning">{{ $postCount }}</h2>
                    <p class="text-muted text-center">จำนวนกระทู้ทั้งหมด</p>
                </div>
            </div>
        </div>

        <!-- Website Visit Count Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">สถิติการเข้าชมเว็บไซต์</h5>
                        <i class="bi bi-bar-chart-line" style="font-size: 2rem; color: #467061;"></i>
                    </div>
                    <h2 class="card-text text-center text-primary">{{ $visitCount }}</h2>
                    <p class="text-muted text-center">การเข้าชมทั้งหมด</p>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <!-- Comment Count Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">จำนวนคอมเมนต์</h5>
                        <i class="bi bi-chat-dots" style="font-size: 2rem; color: #467061;"></i>
                    </div>
                    <h2 class="card-text text-center text-info">{{ $commentCount }}</h2>
                    <p class="text-muted text-center">จำนวนคอมเมนต์ทั้งหมด</p>
                </div>
            </div>
        </div>

        <!-- Caregiver Count Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">จำนวนผู้ดูแล</h5>
                        <i class="bi bi-person-check" style="font-size: 2rem; color: #467061;"></i>
                    </div>
                    <h2 class="card-text text-center text-success">{{ $caregiverCount }}</h2>
                    <p class="text-muted text-center">จำนวนผู้ดูแลทั้งหมด</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Chart for User Statistics -->
    <section class="row">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="card-title">สถิติการใช้งาน (กราฟ)</h5>
                    <canvas id="userStatsChart"></canvas>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log("เริ่มการโหลด JavaScript สำหรับ Chart.js");

        var labels = [
            'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
            'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
        ];
        var data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18, 0];


        var ctx = document.getElementById('userStatsChart');
        if (!ctx) {
            console.error("ไม่พบ Canvas ที่มี id='userStatsChart'");
            return;
        }

        var chartCtx = ctx.getContext('2d');
        if (!chartCtx) {
            console.error("ไม่สามารถสร้าง context สำหรับ Canvas ได้");
            return;
        }

        console.log("สร้าง context สำเร็จ:", chartCtx);

        new Chart(chartCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'จำนวนผู้ใช้งาน',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        console.log("กราฟถูกสร้างแล้ว");
    });
</script>


<style>
    
    /* เพิ่มการกำหนดสีและการปรับแต่ง */
    .card {
        background-color: #ffffff;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 15px #0000001a;
        transform: translateY(-5px);
    }

    .card-title {
        font-weight: 600;
        color: #003e29;
    }

    .card-text {
        font-size: 2rem;
        font-weight: 700;
    }

    .card-body {
        text-align: center;
    }

    .col-md-4 {
        margin-bottom: 20px;
    }

    .shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>
