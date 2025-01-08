@extends('layouts.dashboard')

@section('title', 'แดชบอร์ดการประเมินสุขภาพ')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">แดชบอร์ดการประเมินสุขภาพของผู้สูงอายุ</h1>
        <p class="fs-4 text-muted">การติดตามข้อมูลความเสี่ยงในแต่ละประเภท</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        <!-- ผู้สูงอายุที่มีความเสี่ยง - Card Template -->
        @foreach([['hypertension', 'ความดันโลหิต', $hypertensionRiskCount], ['diabetes', 'โรคเบาหวาน', $diabetesRiskCount], ['oralHealth', 'สุขภาพช่องปาก', $oralHealthRiskCount], ['eyeHealth', 'สุขภาพตา', $eyeHealthRiskCount]] as $risk)
        <div class="col mb-4">
            <div class="card shadow-lg p-4 border-light rounded-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-heart-pulse fs-2 text-primary me-3"></i>
                    <h5 class="fw-bold text-primary flex-grow-1">{{ $risk[1] }}</h5>
                </div>
                <p class="fs-4">{{ $risk[2] }} คน</p>
                <a href="{{ route('dashboard.risks.details', ['type' => $risk[0]]) }}" class="btn btn-primary w-100">ดูรายละเอียด</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- สรุปผลกราฟ -->
    <div class="row">
        <div class="col">
            <div class="card shadow-lg p-4">
                <h5 class="fw-bold text-primary">สรุปความเสี่ยงของผู้สูงอายุ</h5>
                <canvas id="healthRiskChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('healthRiskChart').getContext('2d');
        var healthRiskChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['ความดันโลหิต', 'โรคเบาหวาน', 'สุขภาพช่องปาก', 'สุขภาพตา'],
                datasets: [{
                    label: 'จำนวนผู้สูงอายุที่มีความเสี่ยง',
                    data: [
                        {{ $hypertensionRiskCount }},
                        {{ $diabetesRiskCount }},
                        {{ $oralHealthRiskCount }},
                        {{ $eyeHealthRiskCount }}
                    ],
                    backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(75, 192, 192, 0.5)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)', 'rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' คน'; // Shows exact count when hovered over
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
