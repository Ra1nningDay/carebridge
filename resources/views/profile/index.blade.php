@extends('layouts.app')

@section('title', $user->name)

@section('content')
<!-- ส่วนแบนเนอร์ -->
<div class="banner" style="background-color: #0056b3; height: 250px; position: relative;">
</div>

<div class="container" style="margin-top: -150px; position: relative; z-index: 2;">
    @if (session('error'))
        <div class="toast-container position-fixed start-50 translate-middle-x p-3" style="z-index: 2000; top: 10%;">
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Toast สำหรับ Success -->
    @if (session('success'))
        <div class="toast-container position-fixed start-50 translate-middle-x p-3" style="z-index: 2000; top: 10%;">
            <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <!-- ส่วนโปรไฟล์หลัก -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <!-- ส่วนหัวของผู้ใช้ -->
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $user->avatar_url }}" alt="รูปโปรไฟล์" class="rounded-circle" width="100" height="100">
                        <div class="ms-3">
                            <h2 class="mb-0">{{ $user->name }}</h2>
                            <p class="text-muted">เข้าร่วมเมื่อ: {{ $user->created_at->format('F Y') }}</p>
                        </div>
                        @auth
                            @if (Auth::id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary ms-auto">แก้ไขโปรไฟล์</a>
                            @elseif ($user->caregiver)
                                <a href="{{ route('chat.start', $user->id) }}" class="btn btn-success ms-auto">ส่งข้อความ</a>
                            @endif
                        @endauth
                    </div>

                    <!-- แท็บนำทาง -->
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#overview" data-bs-toggle="tab">ภาพรวม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#posts" data-bs-toggle="tab">กระทู้</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#comments" data-bs-toggle="tab">ความคิดเห็น</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#saved" data-bs-toggle="tab">ที่บันทึกไว้</a>
                        </li>
                        @if ($user->caregiver)
                            <li class="nav-item">
                                <a class="nav-link" href="#caregiver-info" data-bs-toggle="tab">ข้อมูลผู้ดูแล</a>
                            </li>
                        @endif
                    </ul>

                    <!-- เนื้อหาในแท็บ -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="overview">
                            @if ($posts->isEmpty())
                                <p class="text-muted">ยังไม่มีโพสต์ให้แสดง</p>
                            @else
                                @foreach ($posts as $post)
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <p class="card-text">{!! Str::limit($post->content, 150) !!}</p>
                                            <div class="d-flex align-items-center text-muted">
                                                <span class="me-3">⬆️ 1</span>
                                                <span class="me-3">⬇️ 0</span>
                                                <span class="me-3">💬 0</span>
                                                <span class="ms-auto"><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">แก้ไขโพสต์</a></span>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm ms-2">ลบโพสต์</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>


                        <div class="tab-pane fade" id="posts">
                            <p>เนื้อหาแท็บกระทู้ที่นี่</p>
                            @if ($posts->isEmpty())
                                <p class="text-muted">ยังไม่มีโพสต์ให้แสดง</p>
                            @else
                                @foreach ($posts as $post)
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <p class="card-text">{!! Str::limit($post->content, 150) !!}</p>
                                            <div class="d-flex align-items-center text-muted">
                                                <span class="me-3">⬆️ 1</span>
                                                <span class="me-3">⬇️ 0</span>
                                                <span class="me-3">💬 0</span>
                                                <span class="ms-auto"><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">แก้ไขโพสต์</a></span>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm ms-2">ลบโพสต์</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="tab-pane fade" id="comments">
                            <p>เนื้อหาแท็บความคิดเห็นที่นี่</p>
                        </div>
                        <div class="tab-pane fade" id="saved">
                            <p>เนื้อหาแท็บที่บันทึกไว้อยู่ที่นี่</p>
                        </div>
                        @if ($user->caregiver)
                            <div class="tab-pane fade" id="caregiver-info">
                                <h5>ข้อมูลผู้ดูแล</h5>
                                <p>ประสบการณ์: {{ $user->caregiver->experience_years }} ปี</p>
                                <p>ความเชี่ยวชาญ: {{ $user->caregiver->specialization }}</p>
                                <p>คะแนน: ★★★★★ ({{ $user->caregiver->rating }})</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ส่วน Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <img src="{{ $user->avatar_url }}" alt="รูปโปรไฟล์" class="rounded-circle mb-2" width="80" height="80">
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->caregiver ? 'ผู้ดูแล' : 'สมาชิก' }}</p>
                    @if ($user->caregiver)
                        <p class="text-muted">คะแนน: ★★★★★ ({{ $user->caregiver->rating }})</p>
                    @endif
                </div>
                <hr>
                <div class="card-body">
                    <p><strong>{{ $posts->count() }}</strong> กระทู้</p>
                    <p><strong>0</strong> ความคิดเห็น</p>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h6>เกี่ยวกับ {{ $user->name }}</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et urna lacus.</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
