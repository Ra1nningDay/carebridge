<?php 
    require 'db.php';

    if(empty($_SESSION['role']) || $_SESSION['role'] !== "admin") {
        redirectMessage('index.php','error','สิทธิ์ของคุณไม่ถึง')
    }
    
    // $stmt = $conn->query("");
    // $stmt->execute();
    // $topics = $stmt->fetchAll();
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
                    <h1 class="text-capitalize">Evaluation Rating</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="row">Topic</th>
                                    <th scope="row"> Rating</th>
                                </tr>
                            </thead>
                            <?php 
                                foreach ($topics as $topic):
                            ?>
                            <tbody>
                                <tr>
                                    <!-- 
                                         -->
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