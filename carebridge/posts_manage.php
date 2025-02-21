<?php 
    require 'db.php';

    // echo $_SESSION['user_id'];

    // if(empty($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    //     redirectMessage('index.php','error','สิทธิ์ของคุณไม่ถึง')
    // }

    $searchQuery = isset($_GET['search']) && !empty($_GET['search']) ? "%" . $_GET['search'] . "%" : NULL ;
    $stmt = $conn->prepare($searchQuery ? 
    "SELECT * FROM posts WHERE title LIKE ? OR content LIKE ?" : 
    "SELECT * FROM posts");
    $searchQuery ? $stmt->execute([$searchQuery, $searchQuery]) : $stmt->execute(); ;
    $posts = $stmt->fetchAll();

    // Add 
    if (isset($_POST['create'])) {

        $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?,?,?)");
        $stmt->execute([$_SESSION['user_id'], $_POST['title'], $_POST['content']]);
        redirectMessage('posts_manage.php','success' , 'การเพิ่มข้อมูลเสร็จสิ้น');
    }

    // Update
    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
        $stmt->execute([$_POST['title'], $_POST['content'],$_POST['post_id']]);
        redirectMessage('posts_manage.php','success' , 'การแก้ไขข้อมูลเสร็จสิ้น');
    }

    // Delete 
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
        $stmt->execute([$_POST['post_id']]);
        redirectMessage('posts_manage.php','success' , 'การลบข้อมูลเสร็จสิ้น');
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
                    <h1 class="text-capitalize">posts management</h1>

                    <div class="d-flex">
                        <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            Add Post
                        </button>

                        <div id="modalAdd" class="modal fade" tabindex="-1" aria-labelledby="#addTitle" aria-expanded="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-capitalize" id="addTitle">Add Post</h5>
                                        <button class="btn btn-close" aria-label="close" data-bs-dismiss="modal"></button>
                                    </div> 
                                    <div class="modal-body">
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                            <div class="mb-4">
                                                <label for="title" class="text-capitalize mb-1">title</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                            <div class="mb-4">
                                                <label for="content" class="text-capitalize mb-1">content</label>
                                                <input type="text" name="content" class="form-control">
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
                                <input type="search" class="form-control" name="search" value="<?php echo $_GET['search'] ?? NULL;?>" placeholder="title, Name, content">
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
                                    <th scope="row">title</th>
                                    <th scope="row">Author</th>
                                    <th scope="row">content</th>
                                    <th scope="row">Created</th>
                                    <th scope="row">Updated</th>
                                    <th scope="row">Action</th>
                                </tr>
                            </thead>
                            <?php foreach ($posts as $post): ?>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $post['id'] ?></th>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['user_id'] ?></td>
                                    <td><?php echo $post['content'] ?></td>
                                    <td><?php echo $post['created_at'] ?></td>
                                    <td><?php echo $post['updated_at'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalAdd<?php echo $post['id']; ?>">
                                                Edit
                                            </button>

                                            <div id="modalAdd<?php echo $post['id']; ?>" class="modal fade" tabindex="-1" aria-labelledby="#addTitle<?php echo $post['id']; ?>" aria-expanded="false">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addTitle<?php echo $post['id']; ?>">Add post</h5>
                                                            <button class="btn btn-close" aria-label="close" data-bs-dismiss="modal"></button>
                                                        </div> 
                                                        <div class="modal-body">
                                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                                <div class="mb-4">
                                                                    <label for="title" class="text-capitalize mb-1">title</label>
                                                                    <input type="text" name="title" class="form-control" value="<?php echo $post['title'] ?>">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="content" class="text-capitalize mb-1">content</label>
                                                                    <input type="content" name="content" class="form-control" value="<?php echo $post['content'] ?>">
                                                                </div>
                                                                <div class="d-flex justify-content-end">
                                                                    <button class="btn btn-primary" name="update">Save Change</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="confirm('Confirm to Delete data.')">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
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