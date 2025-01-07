@extends('layouts.dashboard')

@section('title', 'แดชบอร์ดการประเมินสุขภาพ')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">แดชบอร์ดการประเมินสุขภาพของผู้สูงอายุ</h1>
        <p class="fs-5 text-muted">การติดตามข้อมูลความเสี่ยงในแต่ละประเภท</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <!-- จำนวนผู้สูงอายุที่มีความเสี่ยงในโรคความดัน -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold text-primary">จำนวนผู้สูงอายุที่มีความเสี่ยง (ความดันโลหิต)</h5>
                <p class="fs-4">{{ $hypertensionRiskCount }} คน</p>
                {{-- <a href="{{ route('healthAssessment.index') }}" class="btn btn-primary">ดูรายละเอียด</a> --}}
            </div>
        </div>

        <div class="col-md-3">
            <!-- จำนวนผู้สูงอายุที่มีความเสี่ยงในโรคเบาหวาน -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold text-primary">จำนวนผู้สูงอายุที่มีความเสี่ยง (โรคเบาหวาน)</h5>
                <p class="fs-4">{{ $diabetesRiskCount }} คน</p>
                {{-- <a href="{{ route('healthAssessment.index') }}" class="btn btn-primary">ดูรายละเอียด</a> --}}
            </div>
        </div>

        <div class="col-md-3">
            <!-- จำนวนผู้สูงอายุที่มีความเสี่ยงในสุขภาพช่องปาก -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold text-primary">จำนวนผู้สูงอายุที่มีความเสี่ยง (สุขภาพช่องปาก)</h5>
                <p class="fs-4">{{ $oralHealthRiskCount }} คน</p>
                {{-- <a href="{{ route('healthAssessment.index') }}" class="btn btn-primary">ดูรายละเอียด</a> --}}
            </div>
        </div>

        <div class="col-md-3">
            <!-- จำนวนผู้สูงอายุที่มีความเสี่ยงในสุขภาพตา -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold text-primary">จำนวนผู้สูงอายุที่มีความเสี่ยง (สุขภาพตา)</h5>
                <p class="fs-4">{{ $eyeHealthRiskCount }} คน</p>
                {{-- <a href="{{ route('healthAssessment.index') }}" class="btn btn-primary">ดูรายละเอียด</a> --}}
            </div>
        </div>
    </div>

    <!-- กราฟแสดงผล -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold text-primary">สรุปความเสี่ยงของผู้สูงอายุ</h5>
                <canvas id="healthRiskChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- แสดงกราฟ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('healthRiskChart').getContext('2d');
        var healthRiskChart = new Chart(ctx, {
            type: 'bar', // กราฟชนิด bar
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
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)', 'rgba(75, 192, 192, 1)'],
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
    </script>
</div>
@endsection
