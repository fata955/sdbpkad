<?php 
session_start(); 
if (isset($_SESSION['username'])) { 
      header('Location: /sdbpkad/home'); 
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Login and SignUp</title>
</head>

<body>

    <div class="container">
        <div class="login-section">
            <header>Login</header>

            <!-- <div class="social-buttons">
                <button><i class='bx bxl-google'></i> Use Google</button>
                <button><i class='bx bxl-apple'></i> Use Apple</button>
            </div> -->

            <div class="separator">
                <div class="line"></div>
                <p>Or</p>
                <div class="line"></div>
            </div>

            <form>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password" name="password" required>
                <a href="#">Forget Password?</a>
                <button type="submit" class="btn login">Login</button>
            </form>

        </div>
        <div class="signup-section">
            <header>Signup</header>

            <!-- <div class="social-buttons">
                <button><i class='bx bxl-google'></i> Use Google</button>
                <button><i class='bx bxl-apple'></i> Use Apple</button>
            </div> -->

            <div class="separator">
                <div class="line"></div>
                <p>Or</p>
                <div class="line"></div>
            </div>
            <form>
                <input type="text" placeholder="Full name" name="" required>
                <input type="text" placeholder="Username" name="" required>
                <input type="password" placeholder="Password" name="" required>
                <a href="#">Forget Password?</a>
                <button type="submit" class="btn signup">Signup</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script>

    </script>
</body>

</html>