<?php 
    require 'db.php';

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    $personal = $conn->prepare("SELECT * FROM user_personal WHERE user_id=?");
    $personal->execute([$_SESSION['user_id']]);
    $user_personal = $personal->fetch();

    
    // Update
    if (isset($_POST['update_user'])) {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->execute([$_POST['name'],$_POST['email'], $_SESSION['user_id']]);
        redirectMessage('profile_edit.php','success' , 'การแก้ไขข้อมูลเสร็จสิ้น');
    }

    if (isset($_POST['update_personal'])) {
        $stmt = $conn->prepare("UPDATE user_personal SET firstname=?, lastname=?, birthdate=?, address=?, phone=?  WHERE user_id=?");
        $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['birthdate'], $_POST['address'], $_POST['phone'], $_SESSION['user_id']]);
        redirectMessage('profile_edit.php','user_persnoal' , 'การแก้ไขข้อมูลเสร็จสิ้น');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="container-fluid my-5">
        <h1 class="text-center mt-5 mb-4">แก้ไขโปรไฟล์</h1>
        <div class="card shadow mx-auto mb-4 p-2" style="width: 800px;">
            <div class="card-body">
                <h5>อัพเดทข้อมูลผู้ใช้งาน</h5>
                <p class="text-muted">เพื่อความปลอดภัย โปรดแก้ไขอีเมล์ของคุณกันซ้ำ</p>
                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible">
                        <?php echo $_GET['success'] ?>
                        <button class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                <?php endif; ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-4">
                        <label for="name" class="form-label">ชื่อ</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">อีเมล์</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                    </div>
                    <button class="btn btn-primary" name="update_user">บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>      

        <div class="card shadow mx-auto mb-4 p-2" style="width: 800px;">
            <div class="card-body">
                <h5>อัพเดทข้อมูลส่วนตัว</h5>
                <p class="text-muted">โปรดแก้ไขข้อมูลส่วนตัวของคุณให้เป็นปัจจุบันเสมอ</p>
                <?php if(isset($_GET['user_personal'])): ?>
                    <div class="alert alert-success alert-dismissible">
                        <?php echo $_GET['user_personal'] ?>
                        <button class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                <?php endif; ?>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-4">
                        <label for="firstname" class="form-label">ชื่อจริง</label>
                        <input type="text" name="firstname" class="form-control" placeholder="กรอกข้อมูลชื่อจริงของคุณ"  value="<?php echo $user_personal['firstname'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="lastname" class="form-label">นามสกุล</label>
                        <input type="text" name="lastname" class="form-control"  placeholder="กรอกข้อมูลนามสกุลของคุณ" value="<?php echo $user_personal['lastname'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="birthdate" class="form-label">วัน/เดือน/ปี เกิด</label>
                        <input type="date" name="birthdate" class="form-control"  placeholder="กรอกข้อมูลวัน/เดือน/ปีเกิดของคุณ" value="<?php echo $user_personal['birthdate'] ?>">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <input type="address" name="address" class="form-control"  placeholder="กรอกข้อมูลที่อยู่ของคุณ" value="<?php echo $user_personal['address'] ?>"> 
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์/ติดต่อ</label>
                        <input type="number" name="phone" class="form-control" minlength="10" placeholder="กรอกข้อมูลเบอร์โทรศัพท์ของคุณ" value="<?php echo $user_personal['phone'] ?>">
                    </div>
                    <button class="btn btn-primary" name="update_personal">บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>   
    </div> 
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>