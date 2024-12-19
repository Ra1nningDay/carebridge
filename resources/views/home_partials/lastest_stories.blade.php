<section style="margin-bottom: 72px; background-color: #f9f9f9; padding: 40px 0;">
    <div class="container">
        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #003e29;">กระทู้ล่าสุด</h2>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-success rounded-pill px-4">สำรวจเพิ่มเติม</a>
        </div>

        <div class="row gy-4">
            <!-- Main article area -->
            <div class="col-lg-8 d-flex flex-column">
                @if($posts->first())
                    <a href="{{ route('posts.show', $posts->first()->id) }}" class="card border-0 shadow-sm text-decoration-none" style="overflow: hidden; border-radius: 16px; background-color: #ffffff;">
                        <img src="{{ asset($posts->first()->image) }}" 
                            class="card-img-top" 
                            alt="Main Article Image" 
                            style="max-height: 370px; object-fit: cover;">
                        <div class="card-body">
                            <p class="text-success fw-semibold mb-1">{{ $posts->first()->author->name ?? 'ผู้เขียนไม่ทราบชื่อ' }}</p>
                            <h3 class="card-title fw-bold mb-3" style="color: #003e29;">{{ $posts->first()->title }}</h3>
                            <p class="text-muted">{!! Str::limit($posts->first()->content, 200) !!}</p>
                            <small class="text-muted">
                                <i class="bi bi-clock-fill"></i> {{ $posts->first()->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </a>
                @endif
            </div>

            <!-- Smaller articles list -->
            <div class="col-lg-4 d-flex flex-column">
                @foreach($posts->skip(1)->take(4) as $post)
                    <a href="{{ route('posts.show', $post->id) }}" class="card mb-4 border-0 shadow-sm d-flex flex-row text-decoration-none" style="overflow: hidden; border-radius: 12px; background-color: #ffffff;">
                        <img src="{{ $post->image ? asset($post->image) : 'https://via.placeholder.com/100' }}" 
                            class="img-fluid" 
                            alt="Small Article Image" 
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <p class="text-success fw-semibold mb-1">{{ $post->author->name ?? 'ผู้เขียนไม่ทราบชื่อ' }}</p>
                            <h6 class="card-title mb-2 fw-bold" style="color: #003e29;">{{ $post->title }}</h6>
                            <small class="text-muted">
                                <i class="bi bi-clock-fill"></i> {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
