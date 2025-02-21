<?php 
    $page = basename($_SERVER['PHP_SELF']);
?>

<style>
    .nav-link.active{
        border-bottom: 2px solid black;
    }

    .nav-link{
        font-size: 18px;
        font-weight: 600;
    }
</style>

<div class="nav navbar navbar-expand-lg bg-light shadow navbar-light sticky-top" >
    <div class="container-fluid" style="max-width: 1320px;">
        <div class="navbar-brand">
            <a href="index.php" class="logo-brand text-decoration-none" style="color: #04240a">
                <div class="d-flex">
                    <img src="imgs/logo1.png" alt="" width="80" height="60">
                    <div class="d-flex flex-column ms-1">
                        <h3 class="m-0">CareBridge</h3>
                        <small>สะพานสู่สังคมผู้สูงอายุ</small>
                    </div>
                </div>
            </a>
        </div>

        <button class="navbar-toggler" data-bs-target="#navbarNav" aria-expanded="false" data-bs-toggle="collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-center" id="navbarNav">
            <ul class="navbar-nav mx-auto" >
                <li class="nav-item px-2">
                    <a href="index.php" class="nav-link <?php echo $page == "index.php" ? "active" : "link-dark";?>">สำรวจ</a>
                </li>
            </ul>

            <?php if(empty($_SESSION['role'])): ?>
                <div class="d-flex">
                    <a href="register.php" class="btn">สมัครสมาชิก</a>
                    <a href="login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
                </div>
            <?php else: ?>
                <div class="dropdown">
                    <button class="btn btn-light rounded-circle p-0 " data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="imgs/logo1.png" class="rounded-circle" alt="" width="32" height="32">
                    </button>

                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-item"><a href="profile_edit.php" class="text-decoration-none text-dark">แก้ไขโปรไฟล์</a></div>
                        <div class="dropdown-item"><a href="evaluations.php" class="text-decoration-none text-dark">ให้คะแนนเว็บไซต์ของเรา</a></div>
                        <div class="dropdown-item"><a href="logout.php" class="text-decoration-none text-dark">ออกจากระบบ</a></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        

        
    </div>
</div>