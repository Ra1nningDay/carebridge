@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050;" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="ปิด"></button>
    </div>
@endif

@if ($evaluationTopics->isEmpty())
    <p class="text-center text-muted mt-4">ไม่มีหัวข้อการประเมินที่สามารถแสดงได้ในขณะนี้</p>
@else
    <!-- Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @auth
                    <form action="{{ route('ratings.store') }}" method="POST">
                        @csrf
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="ratingModalLabel">คุณรู้สึกอย่างไรกับบริการของเรา?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted text-center">เราให้ความสำคัญกับความคิดเห็นของคุณ กรุณาให้คะแนนและแสดงความคิดเห็นเพิ่มเติม</p>
                            @foreach ($evaluationTopics as $topic)
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $topic->title }}</h5>
                                        <p class="card-text text-center text-muted">{{ $topic->description }}</p>
                                        <div class="star-rating mt-3 d-flex justify-content-center">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}-{{ $topic->id }}" name="rating[{{ $topic->id }}]" value="{{ $i }}" required>
                                                <label for="star{{ $i }}-{{ $topic->id }}" title="{{ $i }} ดาว">
                                                    <i class="fas fa-star"></i>
                                                </label>
                                            @endfor
                                        </div>
                                        <textarea name="feedback[{{ $topic->id }}]" class="form-control mt-3" rows="3" placeholder="แสดงความคิดเห็นเพิ่มเติม... (ไม่บังคับ)"></textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">ส่งความคิดเห็น</button>
                        </div>
                    </form>
                @else
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="ratingModalLabel">กรุณาเข้าสู่ระบบ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-muted">คุณจำเป็นต้องเข้าสู่ระบบเพื่อให้คะแนน</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('login') }}" class="btn btn-primary">เข้าสู่ระบบ</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modalId = 'ratingModal';
        const modalElement = document.getElementById(modalId);
        const modal = new bootstrap.Modal(modalElement);

        // ตรวจสอบว่าเคยแสดง Modal หรือไม่
        const hasSeenModal = localStorage.getItem('hasSeenRatingModal');
        if (hasSeenModal) return; // หากเคยแสดงแล้ว ออกจากฟังก์ชัน

        // แสดง Modal เมื่อผู้ใช้งานมี Interaction ที่เหมาะสม
        const showModalOnInteraction = () => {
            modal.show();

            // เก็บสถานะว่าแสดง Modal แล้ว
            localStorage.setItem('hasSeenRatingModal', 'true');

            // ลบ Event Listener
            document.removeEventListener('scroll', showModalOnInteraction);
            document.removeEventListener('click', showModalOnInteraction);
        };

        // รอการ Interaction เช่น Scroll หรือ Click
        document.addEventListener('scroll', showModalOnInteraction, { once: true });
        document.addEventListener('click', showModalOnInteraction, { once: true });
    });

</script>

<style>
    /* การจัดสไตล์ระบบดาว */
    .star-rating {
        position: relative;
        display: flex;
        flex-direction: row-reverse; /* เรียงลำดับดาวแบบย้อนกลับ */
        gap: 0.5rem;
    }

    .star-rating input {
        display: none; /* ซ่อน radio button */
    }

    .star-rating label {
        font-size: 2.5rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s, transform 0.3s;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fffdba; /* สีของดาวเมื่อ hover */
        transform: scale(1.2); /* ขยายดาวเมื่อ hover */
    }

    .star-rating input:checked ~ label {
        color: #ffa500; /* สีของดาวที่เลือก */
    }

    /* Card styling */
    .card {
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Success alert styling */
    .alert-success {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>
