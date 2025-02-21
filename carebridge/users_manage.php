<?php 
    require 'db.php';

    // if(empty($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    //     redirectMessage('index.php','error','สิทธิ์ของคุณไม่ถึง')
    // }

    $searchQuery = isset($_GET['search']) && !empty($_GET['search']) ? "%" . $_GET['search'] . "%" : NULL ;
    $stmt = $conn->prepare($searchQuery ? 
    "SELECT * FROM users WHERE role LIKE ? OR name LIKE ? OR email LIKE ?" : 
    "SELECT * FROM users");
    $searchQuery ? $stmt->execute([$searchQuery, $searchQuery, $searchQuery]) : $stmt->execute(); ;
    $users = $stmt->fetchAll();

    // Add 
    if (isset($_POST['create'])) {
        $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email=?');
        $stmt->execute([$_POST['email']]);
        if($user = $stmt->fetchColumn() > 0) redirectMessage('users_manage.php','error','อีเมล์ซ้ำกับที่มีในระบบ');

        $stmt = $conn->prepare("INSERT INTO users (role,name,email,password) VALUES (?,?,?,?)");
        $stmt->execute([$_POST['role'], $_POST['name'],$_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
        
        $hasInserted = $conn->lastInsertId();

        if ($hasInserted) {
            $add = $conn->prepare("INSERT INTO user_personal (user_id) VALUES (?)");
            $add->execute([$hasInserted]);

            redirectMessage('users_manage.php','success','การสมัครสมาชิกของคุณเสร็จสิ้น');
        } else {
            redirectMessage('users_manage.php','error','การสมัครสมาชิกของคุณล้มเหลว');
        }
    }

    // Update
    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE users SET role=?, name=?, email=?");
        $stmt->execute([$_POST['role'], $_POST['name'],$_POST['email']]);
        redirectMessage('users_manage.php','success' , 'การแก้ไขข้อมูลเสร็จสิ้น');
    }

    // Delete 
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$_POST['user_id']]);
        redirectMessage('users_manage.php','success' , 'การลบข้อมูลเสร็จสิ้น');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="d-flex">
        <!-- sidebar  -->
        <?php include "components/sidebar.php" ?>

        <div class="content w-100">
            <!-- navbar  -->
            <?php include "components/dash_nav.php" ?>
            
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
                    <h1>Users Management</h1>

                    <div class="d-flex">
                        <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            Add User
                        </button>

                        <div id="modalAdd" class="modal fade" tabindex="-1" aria-labelledby="#addTitle" aria-expanded="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTitle">Add User</h5>
                                        <button class="btn btn-close" aria-label="close" data-bs-dismiss="modal"></button>
                                    </div> 
                                    <div class="modal-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="mb-4">
                                                <label for="role" class="text-capitalize mb-1">role</label>
                                                <input type="text" name="role" class="form-control">
                                            </div>
                                            <div class="mb-4">
                                                <label for="name" class="text-capitalize mb-1">name</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="mb-4">
                                                <label for="email" class="text-capitalize mb-1">email</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                            <div class="mb-4">
                                                <label for="password" class="text-capitalize mb-1">password</label>
                                                <input type="password" name="password" class="form-control" minlength="8">
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" name="create">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search" value="<?php echo $_GET['search'] ?? NULL;?>" placeholder="Role, Name, Email">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if(isset($_GET['success'])): ?>
                    <div class="alert alert-success alert-dismissible">
                        <?php echo $_GET['success'] ?>
                        <button class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="row">ID</th>
                                    <th scope="row">Role</th>
                                    <th scope="row">Name</th>
                                    <th scope="row">Email</th>
                                    <th scope="row">Created</th>
                                    <th scope="row">Updated</th>
                                    <th scope="row">Action</th>
                                </tr>
                            </thead>
                            <?php foreach ($users as $user): ?>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $user['id'] ?></th>
                                    <td><?php echo $user['role'] ?></td>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['created_at'] ?></td>
                                    <td><?php echo $user['updated_at'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalAdd<?php echo $user['id']; ?>">
                                                Edit User
                                            </button>

                                            <div id="modalAdd<?php echo $user['id']; ?>" class="modal fade" tabindex="-1" aria-labelledby="#addTitle<?php echo $user['id']; ?>" aria-expanded="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addTitle<?php echo $user['id']; ?>">Add User</h5>
                                                            <button class="btn btn-close" aria-label="close" data-bs-dismiss="modal"></button>
                                                        </div> 
                                                        <div class="modal-body">
                                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                                <div class="mb-4">
                                                                    <label for="role" class="text-capitalize mb-1">role</label>
                                                                    <input type="text" name="role" class="form-control" value="<?php echo $user['role'] ?>">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="name" class="text-capitalize mb-1">name</label>
                                                                    <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="email" class="text-capitalize mb-1">email</label>
                                                                    <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                                                                </div>
                                                                <div class="d-flex justify-content-end">
                                                                    <button class="btn btn-primary" name="update">Save Change</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>