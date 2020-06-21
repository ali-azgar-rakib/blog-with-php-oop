<?php
require_once "../lib/Session.php";
Session::alreadyLogin();
require_once "../config/config.php";
require_once "../lib/Database.php";
require_once "../helpers/Helpers.php";
$query = new Database();

if (isset($_POST['submit'])) {
    $email = Helpers::processData($_POST['email']);
    $password = Helpers::processData($_POST['password']);
    if (empty($email) || empty($password)) {
        echo 'field must be not empty';
    } else {
        $email = $query->link->real_escape_string($email);
        $password = $query->link->real_escape_string($password);
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $query->select($sql);
        if ($result != false) {
            $loginData = $result->fetch_assoc();
            Session::set('login', true);
            Session::set('loginid', $loginData['id']);
            Session::set('email', $loginData['email']);
            Session::set('name', $loginData['name']);
            Session::set('roleid', $loginData['roleid']);
            header('location: index.php');
        } else {
            echo 'credential not match';
        }
    }
}

?>



<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="" method="post">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" placeholder="Email" required="" name="email" />
                </div>
                <div>
                    <input type="password" placeholder="Password" required="" name="password" />
                </div>
                <div>
                    <input type="submit" name='submit' value="Log in" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="forget_password.php">Forget password ?</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>