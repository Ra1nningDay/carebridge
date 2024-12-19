@extends('layouts.html')

@section('title', 'ลืมรหัสผ่าน')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 100px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-center text-primary">ลืมรหัสผ่าน?</h2>
            <p class="text-muted text-center">
                หากคุณลืมรหัสผ่าน ไม่ต้องกังวล เพียงกรอกอีเมลของคุณด้านล่าง เราจะส่งลิงก์สำหรับรีเซ็ตรหัสผ่านให้คุณ
            </p>

            <!-- แสดงสถานะการส่งอีเมล -->
            @if (session('status'))
                <div class="alert alert-success mt-4">
                    {{ session('status') }}
                </div>
            @endif

            <!-- ฟอร์มสำหรับส่งคำขอรีเซ็ตรหัสผ่าน -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- อีเมล -->
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    ส่งลิงก์รีเซ็ตรหัสผ่าน
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
