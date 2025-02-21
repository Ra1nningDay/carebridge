<?php 
    require 'db.php';

    if (isset($_POST['login'])) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password'] )) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if($_SESSION['role'] === "admin") {
                redirectMessage('dashboard.php', 'success', 'การเข้าสู่ระบบของคุณเสร็จสิ้น');
            } else {
                redirectMessage('index.php', 'success', 'การเข้าสู่ระบบของคุณเสร็จสิ้น');
            }
        } else {
            redirectMessage('login.php', 'error', 'อีเมล์หรือรหัสผ่านของคุณไม่ถูกต้อง');
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
            <img src="imgs/logo.png" class="img-fluid"></img>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="p-3">

                    <h1 class="text-center">เข้าสู่ระบบ</h4>
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible mt-4">
                            <?php echo $_GET['error'] ?>
                            <span class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></span>
                        </div>
                    <?php endif; ?>

                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" name="email" required>

                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" required>

                    <button name="login" class="form-control btn btn-primary my-3 fs-4">เข้าสู่ระบบ</button>
                </form>
            </div>
            <div class="card-footer text-center p-2">
                <span>ยังไม่ได้เป็นสมาชิกใช่หรือไม่? <a href="register.php">สมัครสมาชิก</a></span>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>