@extends('layouts.app')

@section('title', 'Healthcare Posts')

@section('content')
<div class="container-fluid" style="max-width: 1320px;">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="pt-5">
                <h4 class="fw-bold text-primary mb-4">Recommended Topics</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Healthy Living Tips</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Nutrition & Diet</a></li>
                    <li class="list-group-item"><a href="#" class="text-decoration-none text-dark">Exercise Routines</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="col-lg-9">
            <div class="pt-4">
                <!-- Search Form -->
                <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="query" value="{{ $query ?? '' }}" class="form-control px-3 py-2" placeholder="ค้นหาโพสต์..." />
                        <button type="submit" class="btn btn-primary px-4">ค้นหา</button>
                    </div>
                </form>

                @if ($posts->isEmpty())
                    <div class="alert alert-warning text-center">ไม่พบโพสต์ที่เกี่ยวข้อง</div>
                @else
                    @foreach ($posts as $post)
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="row g-0">
                                <!-- Post Image -->
                                <div class="col-md-4">
                                    @if ($post->image)
                                        <img src="{{ asset($post->image) }}" class="img-fluid rounded-start post-image" alt="{{ $post->title }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light rounded-start" style="height: 150px; border: 1px solid #ccc;">
                                            <p class="text-muted">ไม่มีรูปภาพ</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Post Details -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="small text-muted mb-1">โดย: <strong>{{ $post->author->name }}</strong> | {{ $post->created_at->format('j M Y') }}</p>
                                        <h5 class="card-title fw-bold"><a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none" style="color: #003e29">{{ $post->title }}</a></h5>
                                        <p class="card-text text-muted">{!! Str::limit($post->content, 150) !!}</p>
                                        <div class="d-flex justify-content-between align-items-center small text-muted">
                                            <span>ความคิดเห็น: {{ $post->comments_count }}</span>
                                            <span>ยอดชม: {{ $post->views }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center mt-4">
                        {{ $posts->appends(['query' => $query])->links('pagination::bootstrap-5') }}
                    </nav>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection

<style>
    /* เพิ่มความเป็น Healthcare */
    /* body {
        background-color: #f8f9fa;
    } */

    .card:hover {
        background-color: #eaf2f8;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .card-title {

    }

    .card-title a:hover {
        color: #007bff !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .pagination .page-link:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .list-group-item:hover {
        background-color: #f1f1f1;
    }

    /* กำหนดขนาดการ์ดและรูปภาพให้คงที่ */
    .card {
        display: flex;
        flex-direction: row;
        overflow: hidden;
        border-radius: 16px;
        background-color: #ffffff;
        height: 200px; /* ให้การ์ดมีขนาดสูงสุดคงที่ */
    }

    .post-image {
        object-fit: cover;
        height: 100%;
        width: 100%;
        max-width: 100%; /* ให้ขนาดรูปภาพไม่เกินขนาดที่กำหนด */
        max-height: 180px; /* ป้องกันการยืดขยายเกินขนาดการ์ด */
    }
</style>
