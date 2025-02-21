<?php 
    require 'db.php';

    if (isset($_POST['register'])) {
        if ($_POST['password'] !== $_POST['verify_password']) {
         redirectMessage('register.php','error','รหัสผ่านของคุณไม่ตรงกัน');
        }

        $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email=?');
        $stmt->execute([$_POST['email']]);
        if($user = $stmt->fetchColumn() > 0) redirectMessage('register.php','error','อีเมล์ซ้ำกับที่มีในระบบ');

        $add = $conn->prepare("INSERT INTO users (role, name, email, password) VALUES ('user', ?, ?, ?)");
        $add->execute([$_POST['name'], $_POST['email'],password_hash($_POST['password'],PASSWORD_DEFAULT)]);
        
        $hasInserted = $conn->lastInsertId();

        if ($hasInserted) {
            $add = $conn->prepare("INSERT INTO user_personal (user_id) VALUES (?)");
            $add->execute([$hasInserted]);

            redirectMessage('login.php','success','การสมัครสมาชิกของคุณเสร็จสิ้น');
        } else {
            redirectMessage('login.php','error','การสมัครสมาชิกของคุณล้มเหลว');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CareBridge</title>
</head>
<body>
    <div class="container-fluid" style="max-width: 500px;">
        <div class="text-center my-5">
            <img src="imgs/logo.png" class="img-fluid">
        </div>
        <div class="card">
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-3">

                    <h1 class="text-center">สมัครสมาชิก</h4>

                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible mt-4">
                            <?php echo $_GET['error'] ?>
                            <span class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></span>
                        </div>
                    <?php endif; ?>

                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="name" class="form-control" name="name" required>

                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" name="email" required>

                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" minlength="8" required>

                    <label for="password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="verify_password" minlength="8" required>

                    <button name="register" class="form-control btn btn-primary my-3 fs-4">สมัครสมาชิก</button>
                </form>
            </div>
            <div class="card-footer text-center p-2">
                <span>มีบัญชีอยู่แล้วใช่หรือไม่? <a href="login.php">เข้าสู่ระบบ</a></span>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>