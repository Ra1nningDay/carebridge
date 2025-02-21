<?php 
    require 'db.php';

    $stmtPost = $conn->prepare("SELECT * FROM posts WHERE id=?");
    $stmtPost->execute([$_GET['post_id']]);
    $post = $stmtPost->fetch();

    if (isset($_GET['create'])) {
        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comments) VALUES (?,?,?)");
        $stmt->execute([$_GET['post_id'], $_SESSION['user_id'], $_GET['comment']]);

        header("location: post_show.php?post_id=" . $_GET['post_id']);
        exit();
    }

    $stmtCommemnt = $conn->prepare("SELECT * FROM comments WHERE post_id=?");
    $stmtCommemnt->execute([$_GET['post_id']]);
    $comments = $stmtCommemnt->fetchAll();

?>

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

        <!-- posts -->
        <section>
            <div class="container-fluid my-5" style="max-width: 1320px;">
                <h1 class="mt-5">บทความ</h1>
                
                <div class="card shadow-sm" style="border-radius: 8px; height: 375px;">

                <!-- ชื่อบทความ -->
                    <div class="card-body">
                        <div class=" p-2 fw-bold fs-5">
                            <?php echo $post['title']; ?>
                        </div>
                        <div class=" p-2 text-muted">
                            <?php echo $post['content']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        <!-- comment -->
        <div class="container-fluid my-5" style="max-width: 1320px;">
            <h1 class="mt-5">ความคิดเห็น</h1>
                
                <div class="card" style="border-radius: 24px;">

                <!-- ชื่อบทความ -->
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']; ?>" >
                        <div class="card-body">
                            <div class=" p-2 fw-bold fs-5">
                                แสดงความคิดเห็นของคุณ
                            </div>
                        <textarea name="comment" id="" cols="30" rows="3" class="form-control mb-3" required></textarea>
                        <button class="fs-5 mt-2 btn-primary" type="" name="create" style="border-radius: 12px;">ส่งความคิดเห็นของคุณ</button>
                        </div>
                    </form>
                </div>
                <?php foreach ($comments as $comment): ?>
                <div class="card mt-3" style="border-radius: 12px;">
                    <div class="card-body">
                        <?php echo $comment['comments'] ?>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>