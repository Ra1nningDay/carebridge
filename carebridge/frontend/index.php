<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CareBridge</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include "components/navbar.php"?>
        <main class="flex-grow-1">

            <!-- HEADER -->
            <section>
                <div class="container-fluid" style="max-width: 1320px;">
                    <div class="row g-2 mx-1">
                        <div class="col-6" style="margin-top: 4rem;">
                            <h5 class="lead text-primary">CareBridge</h5>
                            <h1 class="display-1 fw-bold">สะพานเชื่อม <br>สู่สังคมผู้สุงอายุ</h1>
                            <h class="lead">พื้นที่สำหรับให้คำปรึกษา ให้ความช่วยเหลือ และคำแนะนำเกี่ยวกับปัญหาสุขภาพของผู้สูงอายุ</h>

                            <div class="d-flex my-3">
                                <a href="login.php" class="btn text-white" style="background-color: #e48414; border-radius: 24px;">เข้าร่วมชุมชน</a>
                                <a href="" class="btn ">เรียนรู้เพิ่มเติม</a>
                            </div>

                            <div class="row my-4">
                                <div class="col-5">
                                    <div class="card shadow-sm " style="height: 100px;">
                                        <div class="card-body">
                                            <img src="icon1.png" width="65" height="65" alt="" class="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="card shadow-sm " style="height: 100px;">
                                        <div class="card-body">
                                            <img src="icon2.png" width="65" height="65" alt="" class="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mt-2">
                            <div id="carouselIndicator1" class="carousel slide mt-1" data-bs-ride="carousel" style="max-height: 550px;">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="banner1.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover; ">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="banner2.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover; ">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="banner3.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover; ">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- SERVICES -->
            <section>
                <div class="container-fluid" style="max-width: 1320px;" >
                    <div class="row g-3 my-3">

                        <div class="col-4">
                            <div class="card shadow" style=" height: 250px">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon3.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">พื้นที่ให้คำปรึกษา</div>
                                    <div class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum, tenetur.</div>
                                </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card shadow" style=" height: 250px">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon4.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">การให้ความร่วมมือ</div>
                                    <div class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tenetur dolorem, officia excepturi repellat ab soluta illum pariatur eius temporibus?</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card shadow" style=" height: 250px">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon5.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">การประเมินสุขภาพ</div>
                                    <div class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam pariatur quos quisquam, quia molestias omnis?</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- SUPPORT -->
            <section>
                <div class="container-fluid bg-light my-5 text-center" style="max-height: 600px;" >
                    <h1 class="fw-bold">ความช่วยเหลือ</h1>
                    <h5 class="lead mx-2" max-width>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dolore hic in! Ducimus commodi, ullam sunt saepe molestiae, repellat possimus dolorum impedit vitae laboriosam quasi!</h5>
                    <a href="" class="btn btn-success fs-4" style="border-radius: 24px;">ติดต่อเรา</a>
                </div>
            </section>

            <!-- ABOUTUS -->
            <section>
                <h1 class="fw-bold text-center">เกี่ยวกับเรา</h1>
                <div class="container-fluid" style="max-width: 1320px;">
                    <div class="row g-2">
                        <div class="col-6 my-4">

                        </div>

                        <div class="col-6 my-4">
                            <div class="card" style="max-height: 550px;">
                                <div class="card-body">
                                    <h5 class="card-title">เว็บไซต์ CareBridge</h5>
                                    <div class="card-text text-muted">พวกเราคือกลุ่มนักศึกษาที่ตั้งใจสร้างเว็บไซต์นี้ขึ้นมาด้วยความมุ่งมั่น เพื่อให้บริการชุมชน และช่วยเหลือบุคคลที่ต้องการข้อมูล ปรึกษาปัญหา พูดคุยโต้ตอบ และเป็นสื่อกลางให้กับหน่วยงานภาครัฐต่างๆ</div>
                                    <ul class="mt-2">
                                        <li class="">เน้นการใช้งานง่าย</li>
                                        <li class="">ข้อมูลมีความถูกต้อง</li>
                                        <li class="">เว็บไซต์เข้าถึงง่าย</li>
                                        <li class="">ปรึกษาปัญหาสุขภาพ</li>
                                        <li class="">บทความให้ความรู้</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- REVIEWS -->
            <section>
                <div class="container-fluid my-2 text-center" style="max-width: 1320px;">
                    <h1 class="mt-3 fw-bold">เสียงจากผู้ใช้งาน</h1>
                    
                </div>
            </section>
            
            <!-- POSTS -->
            <!-- <section>
                <div class="row">
                    <div class="col-6">
                        <div class="card" style="height: 575px;">
                            <div class="card-body">
                                <div class="card-img-top">
                                    <img src="" alt="">
                                </div>
                                <div class="card-title">
                                    Lorem, ipsum dolor.
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row g-3"></div>
                    </div>
                </div>
            </section> -->
        </main>
        <footer>
            <div class="container-fluid" style="background-color: #383838;">
                <div class="text-white p-2" style="max-width: 1320px;">
                    2024 Chumphon Vocational College
                </div>
            </div>
        </footer>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>