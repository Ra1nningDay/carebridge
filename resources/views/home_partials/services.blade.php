<section class="services-section" style="margin-bottom: 72px;">
    <div class="container-fluid" style="max-width: 1320px;">
        <div class="row g-3">
            <!-- บัตรบริการ 1 -->
            <div class="col-md-4">
                <div class="services-card h-100 text-center p-4 shadow-sm border-0 rounded-4 position-relative d-flex flex-column">
                    <div class="services-icon mb-3">
                        <img src="{{ asset('images/icons/healthcare.png') }}" width="60" height="60" alt="ไอคอน" class="img-fluid">
                    </div>
                    <h5 class="services-title fw-bold mb-3">ผู้ดูแลมืออาชีพ</h5>
                    <p class="services-text text-muted mt-2 flex-grow-1">ผู้ดูแลของเรามีประสบการณ์สูง พร้อมให้การดูแลที่เอาใจใส่และเฉพาะบุคคล เพื่อยกระดับคุณภาพชีวิตและสร้างความอุ่นใจให้คุณและคนที่คุณรัก</p>
                    <div>
                        <a href="#" class="services-btn text-decoration-none btn-sm px-4 py-1 rounded-5">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>
            
            <!-- บัตรบริการ 2 -->
            <div class="col-md-4">
                <div class="services-card h-100 text-center p-4 shadow-sm border-0 rounded-4 position-relative d-flex flex-column">
                    <div class="services-icon mb-3">
                        <img src="{{ asset('images/icons/handshake.png') }}" width="60" height="60" alt="ไอคอน" class="img-fluid">
                    </div>
                    <h5 class="services-title fw-bold mb-3">การมีส่วนร่วมของชุมชน</h5>
                    <p class="services-text text-muted mt-2 flex-grow-1">เราสร้างเครือข่ายสนับสนุนที่แข็งแกร่ง ผ่านการมีส่วนร่วมของชุมชน พร้อมมอบทรัพยากรที่มีคุณค่าให้กับทุกคนที่เกี่ยวข้อง</p>
                    <div>
                        <a href="#" class="services-btn text-decoration-none btn-sm px-4 py-1 rounded-5">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>
            
            <!-- บัตรบริการ 3 -->
            <div class="col-md-4">
                <div class="services-card h-100 text-center p-4 shadow-sm border-0 rounded-4 position-relative d-flex flex-column">
                    <div class="services-icon mb-3">
                        <img src="{{ asset('images/icons/survey.png') }}" width="60" height="60" alt="ไอคอน" class="img-fluid">
                    </div>
                    <h5 class="services-title fw-bold mb-3">แบบประเมินสุขภาพ</h5>
                    <p class="services-text text-muted mt-2 flex-grow-1">แบบประเมินสุขภาพที่ช่วยคุณวิเคราะห์สถานะสุขภาพปัจจุบันของคุณ พร้อมข้อแนะนำในการดูแลสุขภาพส่วนบุคคล</p>
                    <div>
                        <a href="#" class="services-btn text-decoration-none btn-sm px-4 py-1 rounded-5">เรียนรู้เพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* เอฟเฟกต์ Hover สำหรับบัตรบริการ */
    .services-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #f4f4f4; /* เพิ่มพื้นหลังเพื่อให้ดูนุ่มนวลขึ้น */
    }
    .services-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 62, 41, 0.15); /* เงาเขียวอ่อน */
    }

    /* สไตล์ของไอคอน */
    .services-icon img {
        width: 60px;
        height: 60px;
    }

    /* สไตล์หัวข้อบริการ */
    .services-title {
        color: #003e29; /* Kaitoke Green */
    }

    /* สไตล์ปุ่มบริการ */
    .services-btn {
        background: linear-gradient(135deg, #467061, #003e29); /* ไล่สีจาก Como ถึง Kaitoke Green */
        border: none;
        color: #ffffff;
        transition: all 0.3s ease;
    }
    .services-btn:hover {
        background: linear-gradient(135deg, #003e29, #467061);
        transform: scale(1.05);
    }

    /* สีข้อความบริการ */
    .services-text {
        color: #bcbdbc; /* Pumice */
    }

    /* ปรับความสูงการ์ดให้เท่ากัน */
    .services-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>
