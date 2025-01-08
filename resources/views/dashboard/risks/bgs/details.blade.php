@extends('layouts.dashboard')

@section('title', 'แดชบอร์ดการประเมินสุขภาพ')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">ข้อมูลความเสี่ยงจาก {{ ucfirst($type) }}</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('dashboard.risks.details', ['type' => 'hypertension']) }}" class="btn btn-primary mb-3">
                <i class="fas fa-heartbeat"></i> ความดันโลหิต
            </a>
            <a href="{{ route('dashboard.risks.details', ['type' => 'diabetes']) }}" class="btn btn-primary mb-3">
                <i class="fas fa-bread-slice"></i> โรคเบาหวาน
            </a>
            <a href="{{ route('dashboard.risks.details', ['type' => 'oralHealth']) }}" class="btn btn-primary mb-3">
                <i class="fas fa-tooth"></i> สุขภาพช่องปาก
            </a>
            <a href="{{ route('dashboard.risks.details', ['type' => 'eyeHealth']) }}" class="btn btn-primary mb-3">
                <i class="fas fa-eye"></i> สุขภาพตา
            </a>
        </div>
    </div>

    <div class="card shadow-lg p-4 mb-4">
        <h5 class="fw-bold text-primary">จำนวนผู้สูงอายุที่มีความเสี่ยงในประเภท: {{ ucfirst($type) }}</h5>
        <p class="fs-4 text-muted">จำนวนผู้สูงอายุที่มีความเสี่ยง: <span class="text-primary">{{ $riskCount }} คน</span></p>
    </div>

    {{-- กราฟ  --}}
    @include('dashboard.risks.bgs.details.risk-chart')

    <!-- ตารางรายชื่อผู้สูงอายุที่มีความเสี่ยง -->
    @include('dashboard.risks.bgs.details.risk-table')
</div>

<script>
window.onload = function() {
    var ctxMonth = document.getElementById('riskChartMonth').getContext('2d');
    var riskChartMonth = new Chart(ctxMonth, {
        type: 'line',
        data: {
            labels: @json($riskStatsMonth->pluck('month')),
            datasets: [{
                label: 'จำนวนผู้สูงอายุที่มีความเสี่ยง (รายเดือน)',
                data: @json($riskStatsMonth->pluck('risk_count')),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                duration: 1000,  // Animation duration in milliseconds
                easing: 'easeOutBounce'
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    var ctxDay = document.getElementById('riskChartDay').getContext('2d');
    var riskChartDay = new Chart(ctxDay, {
        type: 'line',
        data: {
            labels: @json($riskStatsDay->pluck('day')),
            datasets: [{
                label: 'จำนวนผู้สูงอายุที่มีความเสี่ยง (รายวัน)',
                data: @json($riskStatsDay->pluck('risk_count')),
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                duration: 1000,  // Animation duration in milliseconds
                easing: 'easeOutBounce'
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
};

</script>

@endsection
