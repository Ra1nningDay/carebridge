@extends('layouts.html')

@section('title', 'เข้าสู่ระบบ')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh; max-width: 1080px;">
        <div class="w-100">
            <!-- Logo Section -->
            <div class="text-center mb-2">
                <img src="{{ asset('images/logos/logo2.png') }}" alt="Logo" class="img-fluid" style="width: 300px;">
            </div>

            <!-- Login Card -->
            <x-card-container>
                <x-slot name="body">
                    <h1 class="fs-3 text-center mb-4">เข้าสู่ระบบบัญชีของคุณ</h1>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                
                        <!-- Email Address -->
                        <div class="pt-3 mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" style="padding: 8px 16px;" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <!-- Password -->
                        <div class="pt-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                @if (Route::has('password.request'))
                                <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                                    ลืมรหัสผ่าน?
                                </a>
                                @endif
                            </div>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" style="padding: 8px 16px;" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                
                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">จดจำฉันไว้</label>
                        </div>
                
                        <div class="pt-2">
                            <button type="submit" class="form-control btn btn-primary" style="padding: 14px 0; font-size: 16px;">
                                เข้าสู่ระบบ
                            </button>
                        </div>
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <p class="m-0 text-center">ใหม่กับ CareBridge? <span><a href="{{ route('register') }}" class="text-primary">สร้างบัญชี</a></span></p>
                </x-slot>
            </x-card-container>
        </div>
    </div>
@endsection
