<?php 
    $page = basename($_SERVER['PHP_SELF']);
?>

<style>
    #sidebar {
        transition: all 0.3s
    }

    #sidebar.collapsed {
        margin-left: -250px;
    }

    .nav-item {
        padding: 8px 15px;
    }
    .nav-link {
        font-size: 20px;
        font-weight: 600;
    }
</style>

<nav id="sidebar" class="d-flex flex-column bg-light navbar-light shadow-sm min-vh-100" style="min-width: 250px; width: 250px;">
    <h1 class="mx-auto my-4"><a href="" class="text-decoration-none text-dark">CareBridge</a></h1>

    <ul class="navbar-nav nav-pills">
        <li class="nav-item"><a href="dashboard.php" class="nav-link px-3 <?php echo $page == "dashboard.php" ? "active text-white" : "text-dark"; ?>">Dashboard</a></li>
        <li class="nav-item"><a href="users_manage.php" class="nav-link px-3 <?php echo $page == "users_manage.php" ? "active text-white" : "text-dark"; ?>"z>User Management</a></li>
        <li class="nav-item"><a href="posts_manage.php" class="nav-link px-3 <?php echo $page == "posts_manage.php" ? "active text-white" : "text-dark"; ?>">Post Overview</a></li>
        <li class="nav-item"><a href="comments_manage.php" class="nav-link px-3 <?php echo $page == "comments_manage.php" ? "active text-white" : "text-dark"; ?>">Comment Overview</a></li>
        <li class="nav-item"><a href="evaluation_topics_manage.php" class="nav-link px-3 <?php echo $page == "evaluation_topics_manage.php" ? "active text-white" : "text-dark"; ?>">Evaluation Topic</a></li>
        <!-- <li class="nav-item"><a href="evaluations_manage.php" class="nav-link px-3 <?php echo $page == "evaluations_manage.php" ? "active text-white" : "text-dark"; ?>">Evaluation Rating</a></li>
        <li class="nav-item"><a href="payments.php" class="nav-link"></a></li> -->
    </ul>
</nav>  