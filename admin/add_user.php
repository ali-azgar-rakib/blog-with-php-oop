<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


?>
<div class="grid_10">
    <div class="box round first grid">


        <h2>Add New User</h2>
        <div class="block copyblock">

            <!-- php code for add category  -->
            <?php

            if (isset($_POST['submit'])) {
                $email    = $query->link->real_escape_string(Helpers::processData($_POST['email']));
                $password = $query->link->real_escape_string(Helpers::processData($_POST['password']));
                $roleId   = $query->link->real_escape_string(Helpers::processData($_POST['roleid']));

                $error = [];

                // check email already exists or not
                $emailCheck      = 0;
                $emailCheckQuery = $query->readAll('users');
                foreach ($emailCheckQuery as $emailFromDb) {
                    if ($email == $emailFromDb['email']) {
                        $emailCheck++;
                    }
                }




                if (empty($email)) {
                    $error['email'] = "<span class='error'> Field shoud not be empty </span>";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = "<span class='error'> Email address not valid </span>";
                } elseif ($emailCheck > 0) {
                    $error['email'] = "<span class='error'>Email Already Exists</span>";
                }

                if (empty($password)) {
                    $error['password'] = "<span class='error'> Field shoud not be empty </span>";
                }
                if (empty($roleId)) {
                    $error['roleid'] = "<span class='error'> Field shoud not be empty </span>";
                }
                if (empty($error)) {
                    $password  = md5($password);
                    $insertSql = "INSERT INTO users(email,password,roleid) VALUES('$email','$password',$roleId)";
                    $result    = $query->insert($insertSql);
                    if ($result) {
                        $success  = "<span class='success'> Added Successfully!</span>";
                        $email    = null;
                        $password = null;
                        $roleId   = null;
                    } else {
                        $failed = "<span class='error'> Not added . something went wrong</span>";
                    }
                }
            }


            ?>
            <?= isset($success) ? $success  : '' ?>
            <?= isset($failed)  ? $failed   : '' ?>


            <!-- php code for add category  -->






            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td><label for="">Email</label></td>
                        <td>
                            <input value="<?= isset($email) ? $email : '' ?>" name='email' type="text"
                                placeholder="Enter Email..." class="medium" />
                            <p>
                                <?= isset($error['email']) ? $error['email'] : '' ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="">Password</label></td>
                        <td>
                            <input value="<?= isset($password) ? $password : '' ?>" name='password' type="password"
                                placeholder="Enter Password..." class="medium" />
                            <p>
                                <?= isset($error['password']) ? $error['password'] : '' ?>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="roleid">
                                <option selected disabled>Select Category</option>
                                <option <?= isset($roleId) && $roleId == 1 ? 'selected' : '' ?> value="1">Admin</option>
                                <option <?= isset($roleId) && $roleId == 2 ? 'selected' : '' ?> value="2">Author
                                </option>
                            </select>
                            <p>
                                <?= isset($error['roleid']) ? $error['roleid'] : '' ?>
                            </p>

                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add User" />
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