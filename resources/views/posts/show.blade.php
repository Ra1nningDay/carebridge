@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="container my-5">
    <!-- โพสต์ -->
    <div class="card mb-4 shadow-sm border-0" style="background-color: #f9f9f9; border-radius: 12px;">
        <div class="card-body">
            <h1 class="card-title text-success fw-bold" style="font-size: 2rem;">{{ $post->title }}</h1>
            <p class="text-muted small mb-4">โพสต์เมื่อ {{ $post->created_at->format('d M Y') }}</p>
            <hr class="text-muted">
            <p class="card-text" style="font-size: 1.2rem; line-height: 1.8; color: #555;">{!! $post->content !!}</p>
        </div>
    </div>

    <!-- จำนวนความคิดเห็น -->
    <h3 class="mb-4 text-success fw-bold" style="font-size: 1.5rem;">ความคิดเห็นทั้งหมด ({{ $commentCount }})</h3>

    <!-- เพิ่มความคิดเห็น -->
    <div class="card mb-4 shadow-sm border-0" style="background-color: #eef6f2; border-radius: 12px;">
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <h5 class="mb-3 text-success fw-bold">แสดงความคิดเห็น</h5>
            <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea class="form-control" name="content" rows="3" required placeholder="แบ่งปันความคิดเห็นของคุณ..." style="border-radius: 8px; border-color: #467061;"></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm px-4" style="border-radius: 25px;">
                    <i class="bi bi-send"></i> ส่งความคิดเห็น
                </button>
            </form>
        </div>
    </div>

    <div class="comments">
        @foreach ($post->comments->whereNull('parent_id') as $comment)
            <div class="card mb-3 shadow-sm border-0" style="border-radius: 12px; background-color: #ffffff;">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <!-- รูปโปรไฟล์ -->
                        <img src="{{ $comment->user->avatar_url ?? asset('images/default-avatar.png') }}" 
                            alt="User Avatar" 
                            class="rounded-circle me-3" 
                            width="50" height="50" 
                            style="object-fit: cover;">

                        <div class="w-100">
                            <!-- ชื่อและวันที่ -->
                            <p class="mb-1 fw-bold" style="color: #467061;">{{ $comment->user->name }}</p>
                            <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>

                            <!-- เนื้อหาความคิดเห็น -->
                            <p class="card-text mt-2" style="font-size: 1rem; line-height: 1.5; color: #333;">
                                {{ $comment->content }}
                            </p>

                            <!-- ปุ่มตอบกลับ -->
                            <button class="btn btn-link btn-sm p-0 text-success" 
                                    onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('d-none')">
                                <i class="bi bi-reply"></i> ตอบกลับ
                            </button>

                            <!-- ฟอร์มตอบกลับ -->
                            <div id="reply-form-{{ $comment->id }}" class="d-none mt-3">
                                <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="d-flex align-items-start mb-2">
                                        <!-- รูปโปรไฟล์ผู้ใช้งาน -->
                                        <img src="{{ auth()->user()->avatar_url ?? asset('images/default-avatar.png') }}" 
                                            alt="User Avatar" 
                                            class="rounded-circle me-3" 
                                            style="width: 40px; height: 40px; object-fit: cover;">

                                        <!-- กล่องข้อความ -->
                                        <textarea class="form-control" name="content" rows="2" required placeholder="พิมพ์คำตอบของคุณ..." style="border-radius: 8px; border-color: #467061;"></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success btn-sm px-3" style="border-radius: 25px;">
                                            <i class="bi bi-send"></i> ส่งคำตอบ
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- ความคิดเห็นที่ตอบกลับ -->
                            @include('posts.partials.comment-children', ['comments' => $comment->children])
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
@endsection
