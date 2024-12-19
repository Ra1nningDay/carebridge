<section class="feedback-section py-5 position-relative" style="background-color: #f9f9f9; margin-bottom: 72px; overflow: hidden;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(70, 112, 97, 0.1), rgba(0, 0, 0, 0.02)); z-index: 1; pointer-events: none;"></div>
    <div class="container position-relative" style="z-index: 2;">
        <h5 class="text-center mb-4 fw-bold" style="font-size: 2rem; color: #003e29">คุณรู้สึกอย่างไรกับบริการของเรา?</h5>
        <p class="text-muted text-center mb-5" style="font-size: 1rem;">เราให้ความสำคัญกับความคิดเห็นของคุณ กรุณาให้คะแนนและแสดงความคิดเห็นเพิ่มเติม</p>
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

        <form action="{{ route('ratings.update') }}" method="POST" class="mx-auto" style="max-width: 720px;">
            @csrf
            @method('PUT')

            @foreach ($evaluationTopics as $topic)
                @php
                    $userRating = $topic->ratings->where('user_id', auth()->id())->first();
                @endphp

                @if ($userRating)
                    <!-- แสดงผลการประเมิน -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body py-4 px-5">
                            <h6 class="card-title text-center fw-bold mb-3" style="font-size: 1.25rem; color: #2c3e50;">การใช้งานง่ายและความสวยงามของเว็บไซต์</h6>
                            <p class="card-text text-center text-muted mb-4" style="font-size: 1rem;">{{ $topic->description }}</p>
                            <div class="text-center">
                                <span class="text-warning" style="font-size: 1.5rem;">
                                    @for ($i = 1; $i <= $userRating->stars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = $userRating->stars + 1; $i <= 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </span>
                            </div>
                            <p class="text-center mt-3"><strong>ความคิดเห็นของคุณ:</strong> {{ $userRating->feedback ?? 'ไม่มีความคิดเห็นเพิ่มเติม' }}</p>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#editForm-{{ $topic->id }}">แก้ไขความคิดเห็น</button>
                            </div>
                        </div>

                        <!-- ฟอร์มแก้ไข -->
                        <div class="collapse mt-3" id="editForm-{{ $topic->id }}">
                            <div class="card-body py-4 px-5 bg-light">
                                <h6 class="text-center mb-3">แก้ไขคะแนนและความคิดเห็น</h6>
                                <div class="star-rating d-flex justify-content-center mt-3">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="edit-star{{ $i }}-{{ $topic->id }}" name="rating[{{ $topic->id }}]" value="{{ $i }}" @if($userRating->stars == $i) checked @endif required>
                                        <label for="edit-star{{ $i }}-{{ $topic->id }}" title="{{ $i }} ดาว">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                                <textarea name="feedback[{{ $topic->id }}]" class="form-control mt-4" rows="3" placeholder="แก้ไขความคิดเห็น...">{{ $userRating->feedback }}</textarea>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- ฟอร์มสำหรับหัวข้อที่ยังไม่เคยประเมิน -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body py-4 px-5">
                            <h6 class="card-title text-center fw-bold mb-3" style="font-size: 1.25rem; color: #2c3e50;">{{ $topic->title }}</h6>
                            <p class="card-text text-center text-muted mb-4" style="font-size: 1rem;">{{ $topic->description }}</p>
                            <div class="star-rating d-flex justify-content-center mt-3">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}-{{ $topic->id }}" name="rating[{{ $topic->id }}]" value="{{ $i }}" required>
                                    <label for="star{{ $i }}-{{ $topic->id }}" title="{{ $i }} ดาว">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            <textarea name="feedback[{{ $topic->id }}]" class="form-control mt-4" rows="3" placeholder="แสดงความคิดเห็นเพิ่มเติม... (ตัวเลือก)"></textarea>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Submit Button -->
            <div class="text-center">
                @if(auth()->check())
                    <button type="submit" class="btn btn-primary w-50 py-2 fw-bold" style="border-radius: 25px; font-size: 1.2rem;">
                        แสดงความคิดเห็น
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-warning w-50 py-2 fw-bold" style="border-radius: 25px; font-size: 1.2rem;">
                        เข้าสู่ระบบเพื่อแสดงความคิดเห็น
                    </a>
                @endif
            </div>

        </form>
    </div>
</section>

<!-- Custom CSS -->
<style>
    .star-rating {
        position: relative;
        display: flex;
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s, transform 0.2s;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffd700; /* Hover color */
        transform: scale(1.2);
    }

    .star-rating input:checked ~ label {
        color: #ff9900; /* Selected color */
    }

    /* .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    } */

    textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>


