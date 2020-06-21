<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
$loginId            = Session::get('loginid');
$roleId             = Session::get('roleid');

$profileSql         = "SELECT * FROM users WHERE id=$loginId";
$profileQuery       = $query->select($profileSql);
$profile            = $profileQuery->fetch_assoc();;


?>
<div class="grid_10">
    <div class="box round first grid">


        <h2>Add New Category</h2>
        <div class="block copyblock">

            <!-- php code for update profile  -->
            <?php

            if (isset($_POST['submit'])) {
                $name       = $query->link->real_escape_string(Helpers::processData($_POST['name']));
                $email      = $query->link->real_escape_string(Helpers::processData($_POST['email']));

                $error      = [];

                // check email already exist or not 
                $emailExists = 0;
                foreach ($query->readAll('users') as $userData) {
                    if ($email == $userData['email']) {
                        if ($profile['email'] == $userData['email']) {
                            continue;
                        } else {
                            $emailExists++;
                        }
                    }
                }

                if (empty($email)) {
                    $error['email'] = "<span class='error'> Field shoud not be empty </span>";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = "<span class='error'> Email address not valid </span>";
                } elseif ($emailExists > 0) {
                    $error['email'] = "<span class='error'>Email already exists</span>";
                }
                if (empty($name)) {
                    $error['name'] = "<span class='error'> Field shoud not be empty </span>";
                }


                if (empty($error)) {
                    $updateSql = "UPDATE users SET email='$email',name='$name' WHERE id=$loginId";
                    $result = $query->insert($updateSql);
                    if ($result) {
                        $success = "<span class='success'> Profile Updated Successfully!</span>";
                    } else {
                        $failed = "<span class='error'> Not Updated . something went wrong</span>";
                    }
                }
            }

            ?>



            <!-- php code for update profile end here  -->


            <!-- show message  -->
            <?= isset($success)     ? $success      : '' ?>
            <?= isset($failed)      ? $failed       : '' ?>




            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td><label for="">Name</label></td>
                        <td>
                            <input value="<?= isset($name) ? $name : isset($profile['name']) ? $profile['name'] : '' ?>"
                                name='name' type="text" placeholder="Enter Your Name..." class="medium" />
                            <p><?= isset($error['name']) ? $error['name'] : '' ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="">Email</label></td>
                        <td>
                            <input
                                value="<?= isset($email) ? $email : isset($profile['email']) ? $profile['email'] : '' ?>"
                                name='email' type="text" placeholder="Enter Your Email Name..." class="medium" />
                            <p><?= isset($error['email']) ? $error['email'] : '' ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php

require_once "inc/footer.php";

?>