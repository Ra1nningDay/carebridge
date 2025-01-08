@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')
<style>
    /* Container Styling */
    .container {
        max-width: 900px; /* Narrower width for content */
    }

    /* Card Styling: Hover effect, border-radius, box-shadow */
    .card {
        border-radius: 10px;
        transition: all 0.3s ease;
        margin-bottom: 1.25rem;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 2px solid #007bff; /* Subtle border around images */
        transition: transform 0.3s ease;
    }

    .card img:hover {
        transform: scale(1.1);
    }

    /* Text styles for card titles, labels, and info */
    .card-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: #333;
    }

    .card p {
        font-size: 1rem;
        color: #333;
        margin-bottom: 5px;
    }

    .card p strong {
        font-weight: 700;
        color: #007bff;
    }

    /* Button Styling */
    .btn-outline-primary {
        border-radius: 30px;
        font-weight: 600;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }

    button[type="submit"] {
        padding: 12px;
        font-size: 1.1rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0069d9;
    }

    /* Input Styling */
    input.form-control, textarea.form-control, input[type="datetime-local"] {
        border-radius: 8px;
        padding: 10px;
    }

    /* Section Titles */
    h5 {
        font-weight: 700;
        color: #007bff;
    }

    /* Additional Classes for Layout */
    .text-center {
        text-align: center;
    }

    .d-flex {
        display: flex;
    }

    .ms-3 {
        margin-left: 15px;
    }

    .text-primary {
        color: #007bff !important;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    /* Alerts */
    .alert-success {
        border-left: 4px solid #28a745;
        background-color: #e2f9e1;
        color: #28a745;
    }
</style>

<div class="container py-5">

    <h1 class="text-center mb-5 text-primary">สร้างนัดหมาย</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    <div class="card p-5 shadow-lg rounded-4 border-info mb-4">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <!-- Elderly Info -->
                <div class="col-md-6">
                    <label for="elderly_name" class="form-label h5 text-primary">ข้อมูลผู้สูงอายุ</label>
                    <div class="card bg-light border-primary shadow-sm rounded-3">
                        <div class="card-body d-flex">
                            <img src="{{ $elderly->avatar_url }}" alt="Elderly Avatar" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div class="ms-3 d-flex flex-column">
                                <h5 class="card-title text-dark mb-1">{{ $elderly->name ?? 'ไม่มีข้อมูลผู้สูงอายุ' }}</h5>
                                <p><strong>อายุ: </strong>{{ $elderly->age ?? 'ไม่ระบุ' }} ปี</p>
                                <p><strong>เบอร์โทร: </strong>{{ $elderly->phone ?? 'ไม่ระบุ' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Caregiver Info -->
                <div class="col-md-6">
                    <label for="caregiver_name" class="form-label h5 text-primary">ข้อมูลผู้ดูแล</label>
                    <div class="card bg-light border-primary shadow-sm rounded-3">
                        <div class="card-body d-flex">
                            <img src="{{ $caregiver->avatar_url }}" alt="Caregiver Avatar" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div class="ms-3 d-flex flex-column">
                                <h5 class="card-title text-dark mb-2">{{ $caregiver->name ?? 'ไม่มีข้อมูลผู้ดูแล' }}</h5>
                                <p><strong>เบอร์โทร: </strong>{{ $caregiver->phone ?? 'ไม่มีข้อมูล' }}</p>
                                <p><strong>อีเมล: </strong>{{ $caregiver->email ?? 'ไม่มีข้อมูล' }}</p>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scheduled At -->
            <div class="mb-4">
                <label for="scheduled_at" class="form-label h5 text-primary">เวลานัดหมาย</label>
                <div class="d-flex justify-content-between">
                    <!-- Date Picker (using input[type="date"]) -->
                    <input type="date" name="scheduled_at_date" class="form-control" value="{{ old('scheduled_at_date') }}" required>

                    <!-- Time Picker (using input[type="time"]) -->
                    <input type="time" name="scheduled_at_time" class="form-control" value="{{ old('scheduled_at_time') }}" required>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label for="notes" class="form-label h5 text-primary">ข้อความเพิ่มเติม</label>
                <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" name="elderly_id" value="{{ $elderly->id }}">
            
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">ยันยันการนัดหมาย</button>
        </form>
    </div>
</div>
@endsection


<script>
    document.querySelectorAll('.btn-select-doctor').forEach(button => {
        button.addEventListener('click', (e) => {
            // ตั้งค่า doctor_id ใน hidden input
            document.getElementById('doctor_id').value = e.target.dataset.id;
            
            // ลบคลาส "selected-doctor" ออกจากทุกปุ่ม
            document.querySelectorAll('.btn-select-doctor').forEach(btn => btn.classList.remove('selected-doctor'));
            
            // เพิ่มคลาส "selected-doctor" ให้ปุ่มที่ถูกเลือก
            e.target.classList.add('selected-doctor');
        });
    });

    // When a doctor is selected, store the doctor ID in hidden input
    document.querySelectorAll('.btn-select-doctor').forEach(button => {
        button.addEventListener('click', (e) => {
            document.getElementById('doctor_id').value = e.target.dataset.id;
            document.querySelectorAll('.btn-select-doctor').forEach(btn => btn.classList.remove('btn-success'));
            e.target.classList.add('btn-success');
        });
    });
</script>

@endsection
