<?php include('includes/header.php');?>
<?php
    session_start();
    if(!$_SESSION['u_name']){
        header('location: login.php');
    }

    $admin = 'admin';
    $user = 'user';

    if($_SESSION['role'] == '1'){
        if($url[0] != $admin){
            echo "<script>  window.location='/Election-Analysis-PHP/portal/admin/dashboard' </script>";
        }
    }elseif($_SESSION['role'] == '0'){
        if($url[0] != $user){
            echo "<script>  window.location='/Election-Analysis-PHP/portal/user/dashboard' </script>";
        }
    }
?>
    
    <?php include($page); ?>

    <!-- Code Start Here -->

    <!-- Code End Here -->
    
<?php include ('includes/footer.php'); ?>