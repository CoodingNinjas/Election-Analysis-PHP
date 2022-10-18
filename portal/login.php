<?php include('includes/header.php');?>
    <title>Login | Nigeria Election History</title>

    <?php 

        $_SESSION['validate_email'] = false;
        $_SESSION['email'] = '';
        $_SESSION['password'] = '';

        if($_POST['login']){
            extract($_POST);

            $_SESSION['e'] = $email;

            // checking email
            $tblquery = "SELECT email FROM users WHERE email = :email";
            $tblvalue = array(
                ':email' => htmlspecialchars($email)
            );
            $checkEmail = $connect->tbl_select($tblquery, $tblvalue);

            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['validate_email'] = true;
            }

            if(empty($email)){
                $_SESSION['email'] = 'email can\'t be empty';
            }else if($_SESSION['validate_email'] != true){
                $_SESSION['email'] = 'invalid email';
            }else if(!$checkEmail){
                $_SESSION['email'] = 'Sorry your email address can\'t be found';
            }else if(strlen($password) < 8){
                $_SESSION['password'] =  'password must be at least 8 characters';
            }else{
                $encryptedPassword = $connect->epass($password);
                $tblquery = "SELECT * FROM users WHERE email = :email && password = :password";
                $tblvalue = array(
                    ':email' => htmlspecialchars($email),
                    ':password' => htmlspecialchars($encryptedPassword)
                );
                $login = $connect->tbl_select($tblquery, $tblvalue);
                if($login){
                    foreach($login as $data){
                        extract($data);

                        $_SESSION['myId'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['email'] = $email;
                        $_SESSION['role'] = $role;
                        $_SESSION['date'] = $date;

                        if($_SESSION['role'] == '1'){
                            echo '<script> window.location="admin_dashboard"; </script>';
                        }else{
                            echo '<script> window.location="dashboard"; </script>';
                        }
                    }
                }else{
                    $_SESSION['password'] =  'Invalid Login credential';
                }
            }
        }
    
    ?>

    <!-- Code Starts Here -->
    <div class="login">
        <header class="signup-header">
            <div class="header-content">
                <h1><span>Welcome Back,</span> <br> Login!</h1>
                <img src="assets/triangle.svg">
            </div>
        </header>
        <main class="main">
            <form class="form" action="login.php" method="POST">
                <div class="form-input">
                    <input type="email" id="email" name="email" placeholder="email" value="<?php echo $_SESSION['e']; ?>">
                    <span><i class="fas fa-envelope"></i></span>
                    <p><?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="form-input">
                    <input type="password" id="password" name="password" placeholder="password">
                    <span><i class="fas fa-lock"></i></span>
                    <p><?php echo $_SESSION['password']; ?></p>
                </div>
                <div class="link">
                    <div class="form-check">
                        <input type="checkbox">
                        <label>Remember me</label>
                    </div>
                    <a href="#">forgot password?</a>
                </div>
                <div class="form-input">
                    <input type="submit" name="login" value="login">
                </div>
            </form> 
            <div class="socials">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </main>
    </div>
    <!-- Code Ends Here -->
    
<?php include ('includes/footer.php'); ?>
