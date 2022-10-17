<?php include('includes/header.php');?>
    <title>Registration | Nigeria Election History</title>

    <?php 
        session_start();
        $_SESSION['username'] = '';
        $_SESSION['validate_email'] = false;
        $_SESSION['email'] = '';
        $_SESSION['word'] = '';
        $_SESSION['password'] = '';
        $_SESSION['number'] = '';

        if($_POST['sign_up']){
            extract($_POST);

            $_SESSION['uname'] = $username;
            $_SESSION['e'] = $email;
            $_SESSION['tel'] = $tel;

            // checking email
            $tblquery = "SELECT email FROM users WHERE email = :email";
            $tblvalue = array(
                ':email' => htmlspecialchars($email)
            );
            $checkEmail = $connect->tbl_select($tblquery, $tblvalue);

            // checking username
            $tblquery = "SELECT username FROM users WHERE username = :username";
            $tblvalue = array(
                ':username' => htmlspecialchars($username)
            );
            $checkUsername = $connect->tbl_select($tblquery, $tblvalue);

            // checking if username contains a special character
            $chars = ['@', '_', '!', '#', '$', '%', '^', '&', '*', '(', ')', '<', '>', '?', '/', '|', '}', '{', '~', ':', ',', '.'];
            foreach ($chars as $char){
                if (strpos($username, $char) !== false) {
                    $_SESSION['username'] = 'error';
                    break;
                }
            }

            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['validate_email'] = true;
            }

            $number = is_numeric($tel);

            if($_SESSION['username'] === 'error'){
                $_SESSION['username'] = 'username do not need a special character';
            }elseif(strlen($username) < 1 || strlen($username) > 10){
                $_SESSION['username'] = 'username should be between 1 to 10 characters';
            }else if(empty($email)){
                $_SESSION['email'] = 'email can\'t be empty';
            }else if($_SESSION['validate_email'] != true){
                $_SESSION['email'] = 'invalid email';
            }else if(empty($tel)){
                $_SESSION['number'] = 'number can\'t be empty';
            }else if($number != 1){
                $_SESSION['number'] = 'Invalid number';
            }else if($password != $confirm_password){
                $_SESSION['password'] =  'password do not match';
            }else if(strlen($password) < 8){
                $_SESSION['word'] =  'password must be at least 8 characters';
            }else if($checkEmail){
                $_SESSION['email'] = 'Sorry your email address is already in use on our site';
            }else if($checkUsername){
                $_SESSION['username'] = 'Sorry your username is already taken';
            }else{
                $encryptedPassword = $connect->epass($password);
                $tblquery = "INSERT INTO users VALUES(:id, :username, :email, :phone, 
                :password, :role, :date)";
                $tblvalue = array(
                    ':id' => NULL,
                    ':username' => htmlspecialchars(ucfirst($username)),
                    ':email' => htmlspecialchars($email),
                    ':phone' => htmlspecialchars($tel),
                    ':password' => htmlspecialchars($encryptedPassword),
                    ':role' => "0",
                    ':date' => date("Y-m-d h:i")
                );
                $insert = $connect->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>alert('inserted');</script>";
                    $_SESSION['uname'] = '';
                    $_SESSION['e'] = '';
                    $_SESSION['tel'] = '';
                }
            }
        }
    ?>
    
    <!-- Code Starts Here -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"></script> -->

    <div class="div">
        <header class="signup-header">
            <div class="header-content">
                <h1><span>Hello,</span> <br> Sign up!</h1>
                <img src="assets/triangle.svg">
            </div>
        </header>
        <main class="main">
            <form class="form" action="registration.php" method="POST">
                <div class="form-input">
                    <input type="text" id="username" name="username" value="<?php echo $_SESSION['uname']; ?>" placeholder="username">
                    <span><i class="fas fa-user"></i></span>
                    <p><?php echo $_SESSION['username']; ?></p>
                </div>
                <div class="form-input">
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['e']; ?>" placeholder="email">
                    <span><i class="fas fa-envelope"></i></span>
                    <p><?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="form-input">
                    <input type="tel" id="tel" name="tel" value="<?php echo $_SESSION['tel']; ?>" placeholder="phone">
                    <span><i class="fas fa-phone-alt"></i></span>
                    <p><?php echo $_SESSION['number']; ?></p>
                </div>
                <div class="form-input">
                    <input type="password" id="password" name="password" placeholder="password">
                    <span><i class="fas fa-lock"></i></span>
                    <p><?php echo $_SESSION['word']; ?></p>
                </div>
                <div class="form-input">
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="confirm password">
                    <span><i class="fas fa-lock"></i></span>
                    <p><?php echo $_SESSION['password']; ?></p>
                </div>
                <div class="form-input form-check">
                    <input type="checkbox">
                    <label>I Accept the Policy and Terms</label>
                </div>
                <div class="form-input">
                    <input type="submit" name="sign_up" value="sign up">
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
    
