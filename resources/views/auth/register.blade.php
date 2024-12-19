@extends('layouts.html')

@section('title', 'สมัครสมาชิก')

@section('content')
    <div class="container-fluid" style="min-height: 100vh; max-width: 1080px;">
        <div class="d-flex pt-5">
            <div class="card d-md-flex d-none border-0 mx-auto pt-5 pe-5" style="width: 100%; max-width: 525px;">
                <h1 class="fs-4">CareBridge</h1>
                <dl class="row m-0 pt-3">
                    <dt class="col-sm-1 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                        </svg>
                    </dt>
                    <dd class="col-sm-11">
                        <div>
                            สร้างบัญชีของคุณและเริ่มต้นการใช้งาน CareBridge ได้เลย!
                        </div>
                    </dd>
                </dl>
                <dl class="row m-0 pt-3">
                    <dt class="col-sm-1 pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                        </svg>
                    </dt>
                    <dd class="col-sm-11">
                        <div>
                            การดูแลที่ไว้วางใจได้ในปลายนิ้วของคุณ
                        </div>
                    </dd>
                </dl>
            </div>
            <x-card-container>
                <x-slot name="body">
                    <h1 class="fs-3 mb-4">สร้างบัญชีของคุณ</h1>
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อ</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="padding: 8px 16px;" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" style="padding: 8px 16px;" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="padding: 8px 16px;" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="padding: 8px 16px;" />
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="form-control btn btn-primary" style="padding: 14px 0; font-size: 16px;">
                                สร้างบัญชี
                            </button>
                        </div>
                        <input type="hidden" name="role_id" value="2">
                    </form>
                </x-slot>
                <x-slot name="footer">
                    <p class="m-0">มีบัญชีอยู่แล้ว? <span><a href="{{ route('login')}}">เข้าสู่ระบบ</a></span></p>
                </x-slot>
            </x-card-container>
        </div>
    </div>
@endsection
