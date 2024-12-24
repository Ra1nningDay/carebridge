<section style="background-color: #f4f4f4; padding: 100px 0; margin-bottom: 72px; position: relative; overflow: hidden;">
    <div class="container-fluid text-center">
        <!-- รูปทรงพื้นหลัง -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(70, 112, 97, 0.15), rgba(0, 0, 0, 0.02)); z-index: 1; pointer-events: none;"></div>
        
        <!-- เนื้อหา -->
        <div class="position-relative" style="z-index: 2;">
            <h2 class="fs-1 mb-4 fw-bold" style="color: #003e29;">ค้นหาผู้ดูแลที่เหมาะสมสำหรับคนที่คุณรัก</h2>
            <p class="mb-4 text-muted fs-5">
                เชื่อมต่อกับผู้ดูแลที่คุณวางใจได้ในพื้นที่ของคุณ ให้เราช่วยคุณดูแลคนที่คุณรักอย่างดีที่สุด
            </p>
            {{-- <a href="{{route('caregiver')}}" class="btn btn-lg btn-primary btn-find-caregiver">ค้นหาผู้ดูแลทันที</a> --}}
        </div>
    </div>
</section>
    
<style>
    /* Button Styling */
    .btn-find-caregiver {
        background-color: #467061;
        border-color: #467061;
        color: #ffffff;
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 1.25rem;
        font-weight: bold;
        box-shadow: 0 8px 15px rgba(70, 112, 97, 0.3);
        transition: all 0.3s ease;
    }
    .btn-find-caregiver:hover {
        background-color: #003e29;
        border-color: #003e29;
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 62, 41, 0.4);
    }

    /* Section Styling */
    section {
        position: relative;
        overflow: hidden;
    }

    /* Animated Shapes (Optional) */
    section::before,
    section::after {
        content: '';
        position: absolute;
        background: rgba(70, 112, 97, 0.1);
        z-index: 0;
        border-radius: 50%;
        animation: floating 8s infinite ease-in-out;
    }
    section::before {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 15%;
    }
    section::after {
        width: 150px;
        height: 150px;
        bottom: 15%;
        right: 20%;
    }

    /* Floating Animation */
    @keyframes floating {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(20px);
        }
        100% {
            transform: translateY(0px);
        }
    }
</style>
