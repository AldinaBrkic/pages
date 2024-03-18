<?php 
    SESSION_START();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <?php 
                    
                    include("php/config.php");
                    if(isset($_POST['submit'])){
                        $email = mysqli_real_escape_string($con, $_POST['email']);   
                        $password = mysqli_real_escape_string($con, $_POST['password']); 
                        
                        $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                        $row = mysqli_fetch_assoc($result);

                        if(is_array($row) && !empty($row)){
                            $_SESSION['username'] = $row['Username'];
                            $_SESSION['lastname'] = $row['lastname'];
                            $_SESSION['email'] = $row['Email'];
                            $_SESSION['valid'] = $row['Email'];
                            $_SESSION['id'] = $row['Id']; 
                            
                        }else {
                            echo "<div class='message'>
                                    <p>Wrong email or password</p>
                                 </div></br> ";
                            echo "<a href='index.php'><button class='btn'>Go Back</button>";
                        }
                        if(isset($_SESSION['valid'])){
                            header("Location: home.php");
                        }
                    }else{

                    
                ?>
                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div> 
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"  required>
                    </div> 
                    <div class="field input">
                        <input type="submit" name="submit" class="btn" value="Login" required>
                    </div> 
                    <div class="links">
                        Don't have account?<a href="register.php"> Sign Up</a>
                    </div>
                </form>
                
            </div>
        </div>
        <?php }?>
    </body>
</html>