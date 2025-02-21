<?php 
    require 'db.php';

    $stmt = $conn->prepare("SELECT COUNT(*) FROM evaluations WHERE user_id=?");
    $stmt->execute([$_SESSION['user_id']]);
    $hasEvaluated = $stmt->fetchColumn();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        foreach ($_POST['scores'] as $topic_id => $score) {
            $stmt = $conn->prepare("INSERT INTO evaluations (user_id, topic_id, score) VALUES (?,?,?)");
            $stmt->execute([$_SESSION['user_id'], $topic_id, $score]);
        }
        redirectMessage('evaluations.php','success','ขอบคุณที่ช่วยประเมินเว็บไซต์ของเรา การประเมินของคุณเสร็จสมบูรณ์');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 3.25rem;
            color: #ccc;
            cursor: pointer;
        }

        .star-rating input:checked ~ label {
            color: #f5c518;
        }

        .star-rating label:hover
        ,.star-rating label:hover ~ label {
            color: #f5c518;
        }
    </style>
</head>
<body>
    <?php include "components/navbar.php"?>
    <div class="container-fluid my-5">
        <?php
            if ($hasEvaluated):
        ?>
        <h1 class="text-center mt-5 mb-4">แบบประเมินเว็บไซต์</h1>
            <div class="card mx-auto shadow-sm" style="width: 800px;">
                <div class="card-body text-center">
                    <h5 class="fw-bold">ขอบคุณที่ช่วยประเมินเว็บไซต์ของเรา</h5>
                    <p class="text-muted">การประเมินของคุณเสร็จสมบูรณ์!</p>
                </div>
            </div>
        <?php else: ?>
            <h1 class="text-center mt-5 mb-4">แบบประเมินเว็บไซต์</h1>
            <div class="d-flex justify-content-center ">
                
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="">
                <?php 
                    $stmt = $conn->query("SELECT * FROM evaluation_topics");
                    $stmt->execute();
                    $topics = $stmt->fetchAll();
                    
                    foreach ($topics as $topic):
                ?>
                <div class="card text-center shadow-sm p-4 mb-4" style="width: 800px;">
                    <h5 class="fw-bold"><?php echo $topic['topic_name'] ?></h5>
                    <div class="star-rating justify-content-center">
                        <input type="radio" id="star5_<?php echo $topic['id']; ?>" name="scores[<?php echo $topic['id']; ?>]" value="5">
                        <label for="star5_<?php echo $topic['id']; ?>">&#9733;</label>

                        <input type="radio" id="star4_<?php echo $topic['id']; ?>" name="scores[<?php echo $topic['id']; ?>]" value="4">
                        <label for="star4_<?php echo $topic['id']; ?>">&#9733;</label>

                        <input type="radio" id="star3_<?php echo $topic['id']; ?>" name="scores[<?php echo $topic['id']; ?>]" value="3">
                        <label for="star3_<?php echo $topic['id']; ?>">&#9733;</label>

                        <input type="radio" id="star2_<?php echo $topic['id']; ?>" name="scores[<?php echo $topic['id']; ?>]" value="2">
                        <label for="star2_<?php echo $topic['id']; ?>">&#9733;</label>

                        <input type="radio" id="star1_<?php echo $topic['id']; ?>" name="scores[<?php echo $topic['id']; ?>]" value="1">
                        <label for="star1_<?php echo $topic['id']; ?>">&#9733;</label>
                    </div>
                </div>
                <?php endforeach;?>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg mt-4">ส่งแบบประเมิน</button>
                </div>
            </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>