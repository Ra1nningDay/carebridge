<?php 
    require 'db.php';
    

    // if(empty($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    //     redirectMessage('index.php','error','สิทธิ์ของคุณไม่ถึง')
    // }

    $searchQuery = isset($_GET['search']) && !empty($_GET['search']) ? "%" . $_GET['search'] . "%" : NULL ;
    $stmt = $conn->prepare($searchQuery ? 
    "SELECT * FROM comments WHERE post_id LIKE ? OR user_id LIKE ? OR comments LIKE ?" : 
    "SELECT * FROM comments");
    $searchQuery ? $stmt->execute([$searchQuery, $searchQuery]) : $stmt->execute(); ;
    $comments = $stmt->fetchAll();
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
                    <h1 class="text-capitalize">Comments</h1>
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
                                    <th scope="row">Post</th>
                                    <th scope="row">User</th>
                                    <th scope="row">Comment</th>
                                    <th scope="row">Created</th>
                                    <th scope="row">Updated</th>
                                </tr>
                            </thead>
                            <?php foreach ($comments as $comment): ?>
                            <tbody>
                                <tr>
                                    <th scope="col"><?php echo $comment['id'] ?></th>
                                    <td><?php echo $comment['post_id'] ?></td>
                                    <td><?php echo $comment['user_id'] ?></td>
                                    <td><?php echo $comment['comments'] ?></td>
                                    <td><?php echo $comment['updated_at'] ?></td>
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