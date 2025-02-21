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
        <img class="img-fluid" width="100"></img>
        <div class="card shadow">
            <div class="card-body ">
                <form action="" class="p-3">

                    <h1 class="text-center">สมัครสมาชิก</h4>

                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="name" class="form-control" name="name" required>

                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" name="email" required>

                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" required>

                    <label for="password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="verify_password" required>

                    <a href="" class="form-control btn btn-primary my-3 fs-4">สมัครสมาชิก</a>
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