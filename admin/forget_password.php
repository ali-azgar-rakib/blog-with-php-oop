<?php
require_once "../lib/Session.php";
Session::alreadyLogin();
require_once "../config/config.php";
require_once "../lib/Database.php";
require_once "../helpers/Helpers.php";
$query = new Database();

if (isset($_POST['submit'])) {
    $email = Helpers::processData($_POST['email']);
    $error = null;
    if (empty($email)) {
        $error = "<span style='color:red'>Field must not be empty</empty>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "<span style='color:red'>Email address not valid</empty>";
    }
    if (empty($error)) {
        $sql          = "SELECT * FROM users WHERE email = '$email'";
        $runQuery     = $query->select($sql);
        if ($runQuery) {
            if ($runQuery->num_rows) {
                $passRestData = $runQuery->fetch_assoc();
                echo $email        = $passRestData['email'];
                echo "<br>";
                $subStr = substr($email, 0, 3);
                $random = rand(10000, 80000);
                echo $pass = $subStr . $random;

                // need to be done - send password to user 



            } else {
                $error = "<span style='color:red'>Email address not found</empty>";
            }
        } else {

            $error = "<span style='color:red'>Email address not found</empty>";
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
                <h1>Restore Password</h1>
                <div>
                    <input type="text" placeholder="Email" name="email" />
                </div>
                <?= !empty($error) ? $error : '' ?>
                <?= isset($notFound) ? $notFound : '' ?>
                <div>
                    <input type="submit" name='submit' value="Restore" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="login.php">Login</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>