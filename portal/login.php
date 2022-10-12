<?php include('includes/header.php');?>
    
    <!-- Code Starts Here -->
    <!-- Code Ends Here -->
    
<?php include ('includes/footer.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"></script>

</head>
<body>
    <div class="div">
        <header class="login-header">
            <div class="header-content">
                <h1><span>Welcome Back,</span> <br> Login!</h1>
                <img src="assets/triangle.svg">
            </div>
            
        </header>
        <main class="main">
                <form class="form">
                    <div class="form-input">
                        <input type="email" id="email" name="email" placeholder="email" required>
                        <span><i class="fas fa-envelope"></i></span>
                    </div>
                    <div class="form-input">
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <span><i class="fas fa-lock"></i></span>
                        
                    </div>
                    <div class="link">
                        <div class="form-check">
                            <input type="checkbox">
                            <label>Remember me</label>
                        </div>
                        <a href="#">forgot password?</a>
                    </div>
                    <div class="form-input">
                        <input type="submit" value="login">
                    </div>
                </form> 
                <div class="socials">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                
                
                
                </div>
            </main>
    </div>
    
</body>
</html>