<?php 
    require 'db.php';

    include "visit.php";

    $stmtUser = $conn->prepare("SELECT COUNT(*) FROM users");
    $stmtUser->execute();
    $countUser = $stmtUser->fetchColumn();

    $stmtVisit = $conn->prepare("SELECT COUNT(*) FROM visits");
    $stmtVisit->execute();
    $countVisit = $stmtVisit->fetchColumn();

    $stmtPost = $conn->prepare("SELECT * FROM posts LIMIT 1");
    $stmtPost->execute();
    $posts = $stmtPost->fetchAll();

    $stmtPosts = $conn->prepare("SELECT * FROM posts LIMIT 3 ;");
    $stmtPosts->execute();
    $thPosts = $stmtPosts->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CareBridge || สะพานสู่สังคมผู้สูงอายุ</title>
</head>
<body class="d-flex flex-column min-vh-100">
        <?php include "components/navbar.php"?>
        <main class="flex-grow-1">
            <!-- HEADER -->
            <section>
                <div class="container-fluid mb-2" style="max-width: 1320px;">
                    <div class="row g-2 mx-1">
                        <div class="col-6" style="margin-top: 10rem;">
                            <h5 class="lead text-primary mb-0">CareBridge</h5>
                            <h1 class="display-1 fw-bold mb-4">สะพานเชื่อม <br>สู่สังคมผู้สุงอายุ</h1>
                            <h5 class="text-muted mb-4">พื้นที่สำหรับให้คำปรึกษา ให้ความช่วยเหลือ และคำแนะนำเกี่ยวกับปัญหาสุขภาพของผู้สูงอายุ</h5>

                            <div class="d-flex">
                                <a href="login.php" class="btn btn-lg text-white" style="font-size: 24px; background-color: #e48414; border-radius: 20px;">เข้าร่วมชุมชน</a>
                                <a href="" class="btn btn-lg ms-2" style="font-size: 24px;">เรียนรู้เพิ่มเติม</a>
                            </div>

                            <div class="row my-5">
                                <div class="col-5">
                                    <div class="card shadow-sm " style="height: 100px;">
                                        <div class="card-body d-flex">
                                            <img src="imgs/icon1.png" width="65" height="65" alt="" class="">
                                            <div class="d-flex flex-column w-100 ms-2">
                                                <h5 class="fw-bold">จำนวนสมาชิก:</h5>
                                                <span class="fs-5"><?php echo $countUser ?> คน</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="card shadow-sm " style="height: 100px;">
                                        <div class="card-body d-flex">
                                            <img src="imgs/icon2.png" width="65" height="65" alt="" class="">
                                            <div class="d-flex flex-column w-100 ms-2">
                                                <h5 class="fw-bold">จำนวนผู้เข้าชม:</h5>
                                                <span class="fs-5"><?php echo $countVisit  ?> วิว</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6" style="margin-top: 4rem;">
                            <div id="carouselIndicator1" class="carousel slide mt-1" data-bs-ride="carousel" style="height: 100%">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselIndicator1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner shadow-sm" style="border-radius: 20px;">
                                    <div class="carousel-item active">
                                        <img src="imgs/banner1.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="imgs/banner2.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover; ">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="imgs/banner3.png" alt="" class="d-block w-100 bg-dark" style="object-fit: cover; ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SERVICES -->
            <section style="margin-bottom: 108px; margin-top:" >
                <div class="container-fluid" style="max-width: 1320px;" >
                    <div class="row g-3 my-3">

                        <div class="col-4">
                            <div class="card shadow p-4" style="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon3.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">พื้นที่ให้คำปรึกษา</div>
                                    <div class="card-text">โดยมีผู้เชี่ยวชาญที่เกี่ยวข้องและเชื่อถือได้ มาให้คำปรึกษาในด้านต่างๆ เช่น สุขภาพ ร่างกาย จิตใจ และความรู้เพิ่มเติม</div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card shadow p-4" style="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon4.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">การให้ความร่วมมือ</div>
                                    <div class="card-text">พวกเราให้ความร่วมมือกับหน่วยงานภาครัฐและเอกชนโดยทำให้การเก็บข้อมูลจากผู้สูงอายุมีความสะดวกมากขึ้น</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card shadow p-4" style="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="" style="object-fit: cover;" width="100" height="100" src="imgs/icon5.png" alt="">
                                    <div class="card-title p-1 fs-4 fw-bold">การประเมินสุขภาพ</div>
                                    <div class="card-text">แบบประเมินสุขภาพต่างๆเพื่อนำมาใช้ในการตรวจสอบข้อมูล หรือเป็นข้อมูลเบื้องต้นในการสำรวจตนเองหรือคนรอบข้าง</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- SUPPORT -->
            <section style="margin-bottom: 108px;">
                <div class="container-fluid bg-light my-5 text-center" style="padding: 100px 0;">
                    <h1 class="fw-bold mb-4">ความช่วยเหลือ</h1>
                    <h5 class="fs-3 lead">พวกเราพร้อมสนับสนุนและตอบคำถามหากมีข้อสงสัยในกาารใช้งานในหน้าเว็บไซต์หรือต้องการให้ผลตอบรับเกี่ยวกับประสบการ์ <br> การใช้งานต่างๆในส่วนข้อมูล หรือต้องการติดต่อกับผู้พัฒนาโดยตรงได้</h5>
                    <a href="mailto:tossaporn@gmail.com" class="btn btn-success fs-4 mt-4" style="border-radius: 24px;">ติดต่อเราได้ที่นี่</a>
                </div>
            </section>

            <!-- ABOUTUS -->
            <section style="margin-bottom: 108px;">
                <h1 class="fw-bold text-center mb-5">เกี่ยวกับเรา</h1>
                <div class="container-fluid" style="max-width: 1320px;">
                    <div class="row g-4">
                        <div class="col-6 my-4">
                            <div class="row">
                                <div class="col-6">
                                    <img class="image-fluid shadow" src="imgs/banner1.png" alt="" style="width: 100%; height: 550px">
                                </div>
                                <div class="col-6">
                                    <img class="image-fluid shadow" src="imgs/banner3.png" alt="" style="width: 100%; height: 380px">
                                    <div class="card shadow-sm border-0 p-2 mt-3 bg-success" style="height: 155px;">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <h1 class="fw-bold text-white" style="font-size: 30px;">ความตั้งใจ 100%</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 my-4">
                            <div class="card" style="max-height: 600px; height: 550px;">
                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="card-title fw-bold">เว็บไซต์ CareBridge</h5>
                                    <div class="card-text text-muted mb-2">พวกเราคือกลุ่มนักศึกษาที่ตั้งใจสร้างเว็บไซต์นี้ขึ้นมาด้วยความมุ่งมั่น เพื่อให้บริการชุมชน และช่วยเหลือบุคคลที่ต้องการข้อมูล ปรึกษาปัญหา พูดคุยโต้ตอบ และเป็นสื่อกลางให้กับหน่วยงานภาครัฐต่างๆ</div>
                                    <div class="card-text text-muted mb-2">ดังนั้นเราจึงจัดทำเว็บไซต์ ที่มีประสิทธิภาพและเป็นอีกหนึ่งช่องทางในการสร้างสังคมสำหรับผู้สูงอายุ</div>
                                    <ul class="mt-2">
                                        <li class="">เน้นการใช้งานง่าย</li>
                                        <li class="">ข้อมูลมีความถูกต้อง</li>
                                        <li class="">ข้อมูลมีความประสิทธิภาพ</li>
                                        <li class="">เว็บไซต์เข้าถึงง่าย</li>
                                        <li class="">ปรึกษาปัญหาสุขภาพ</li>
                                        <li class="">บทความให้ความรู้</li>
                                        <li class="">การให้บริการที่ดี</li>
                                        <li class="">มีความปลอดภัย</li>
                                        <li class="">ผู้ใช้งานสามารถแสดงความคิดเห็นได้</li>
                                    </ul>
                                    <button class="btn btn-success w-100 mt-auto btn-lg">เรียนรู้เพิ่มเติม</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- REVIEWS -->
            <!-- <section style="margin-bottom: 108px;">
                <div class="container-fluid bg-light my-5 text-center" style="padding: 100px 0;">
                    <h1 class="fw-bold mb-4">เสียงจากผู้ใช้งาน</h1>
                    <div class="row">
                        <div class="col-4">
                            
                        </div>
                    </div>
                </div>
            </section> -->
            
            <!-- POSTS -->
            <section style="margin-bottom: 108px;">
                <div class="container-fluid my-5" style="max-width: 1320px;">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold">กระทู้สนทนาล่าสุด</h1>
                    <!-- <h5 class=""><a href="" class="btn btn-primary" style="border-radius: 20px;">ดูรายการกระทู้เพิ่มเติม</a></h5> -->
                </div>
                    <div class="row">
                        <?php foreach ($posts as $post): ?>
                        <div class="col-7">
                            <div class="card shadow" style="height: 555px; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="card-img-top">
                                        <img class="bg-light w-100 " src="imgs/logo1.png" alt="" style="height: 350px;">
                                    </div>
                                    <div class="card-title">
                                        <h1 class="mt-3 fs-3 "><a href="" class="text-decoration-none text-dark"><?php echo $post['title'] ?></a></h1>
                                    </div>
                                    <div class="card-content">
                                        <p><?php echo  $post['content'] ?></p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="post_show.php?post_id=<?php echo $post['id']?>" class="btn btn-primary">อ่านเพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="col-5">
                            <?php foreach ($thPosts as $thpost): ?>
                            <div class="row g-3">
                                <div class="card shadow mb-3" style="height: 175px; border-radius: 8px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 p-0">
                                                <img class="bg-light w-100 img-fluid" src="imgs/logo1.png" alt="" style="height: 140px;">
                                            </div>
                                            <div class="col-8">
                                                <div class="post-title">
                                                    <h1 class="mt-3 fs-5 "><a href="" class="text-decoration-none text-dark"><?php echo $thpost['title'] ?></a></h1>
                                                </div>
                                                <div class="card-content">
                                                    <p class="mb-1"><?php echo $thpost['content']?></p>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <a href="" class="btn btn-primary">อ่านเพิ่มเติม</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer style="background-color: #383838;">
            <div class="container-fluid" style="max-width: 1320px;">
                <div class="text-white p-2">
                    2024 Chumphon Vocational College
                </div>
            </div>
        </footer>
    <script src="jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>