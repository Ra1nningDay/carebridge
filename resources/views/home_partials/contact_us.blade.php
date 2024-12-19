<section class="position-relative py-5">
    <!-- Bottom Green Background -->
    <div class="half-background-bottom"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="card shadow border-0 p-5">
            <!-- Heading Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bold contact-title">ติดต่อเรา</h2>
                <h2 class="text-muted fs-5">เราพร้อมที่จะเชื่อมต่อกับคุณ ส่งข้อความหาหรือมาเยี่ยมเราได้ตามสะดวก</h2>
            </div>
            
            <!-- Content Section -->
            <div class="row g-4 align-items-stretch">
                <!-- Contact Info -->
                <div class="col-md-6">
                    <div class="bg-white rounded-3 p-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <p class="mb-3"><i class="fas fa-map-marker-alt text-success me-2" style="font-size: 16px;"></i>F5WM+FJ9 ถนนพิศิษฐ์พยาบาล ตำบล ท่าตะเภา อำเภอเมืองชุมพร ชุมพร 86000</p>
                            <p class="mb-3"><i class="fas fa-phone-alt text-success me-2" style="font-size: 16px;"></i> +077511218</p>
                            
                            <div class="d-flex flex-column gap-3 mt-3">
                                <a href="https://www.facebook.com/PublicRelation.cpvc" class="text-success"><i class="fab fa-facebook fa-lg" style="font-size: 16px;"> งานประชาสัมพันธ์วิทยาลัยอาชีวศึกษาชุมพร </i></a>
                                <a href="http://km.cpvc.ac.th/" class="text-success text-decoration-none"><i class="fab fa-google fa-lg" style="font-size: 14px;"></i> http://km.cpvc.ac.th/</a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.7112278972587!2d99.184106315234!3d10.496164692541088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30520f14f2e8f9f5%3A0x8277270d6e01c795!2z4Lia4Lij4Li04Lip4Liy4LiU4Li14Liq4Li04LiZ4Liy4LiE4Li44Lij4Liq4LmM4LiB4Li14Lij4LiX4LmM4LiX4Lie4Li04Liq4Lih4Li04LiH4LiE!5e0!3m2!1sth!2sth!4v1700000000000!5m2!1sth!2sth" 
                                width="100%" 
                                height="300" 
                                style="border:0; border-radius: 12px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>


                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-md-6">
                    <div class="bg-white rounded-3 p-4 h-100">
                        <h3 class="mb-4" style="color: #467061;">ฝากข้อความถึงเรา</h3>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="ชื่อ" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="อีเมล" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="11" placeholder="เขียนข้อความของคุณที่นี่" required></textarea>
                            </div>
                            <button type="submit" class="btn w-100 text-white" style="background-color: #467061;">ส่งข้อความ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Styles for Contact Section -->
<style>
    /* Background split horizontally with green at the bottom */
    .half-background-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background-color: #003e29;
        z-index: 0;
    }

    /* Contact Container Styling */
    .contact-title {
        color: #467061;
        font-size: 2rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Text and Icons Styling */
    .contact-info i, .social-icons a {
        color: #467061;
    }

    .contact-info i {
        margin-right: 10px;
    }

    .social-icons a {
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    .social-icons a:hover {
        color: #003e29;
    }

    /* Contact Form Styling */
    .contact-form h3 {
        color: #467061;
    }

    .contact-form button:hover {
        background-color: #003e29;
    }

    /* Card Styling */
    .card {
        background-color: #ffffff;
        border-radius: 15px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }

        .contact-title {
            font-size: 1.5rem;
        }

        .row.g-4 {
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
        }

        iframe {
            height: 250px;
        }
    }
</style>

<!-- Font Awesome and Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
