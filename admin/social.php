<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


// data from db 

$socailQuery = $query->readAll('social_links');
$socail_links = $socailQuery->fetch_assoc();

// update socail links 

if (isset($_POST['submit'])) {
    $facebook   = $query->link->real_escape_string($_POST['facebook']);
    $twitter    = $query->link->real_escape_string($_POST['twitter']);
    $linkedin   = $query->link->real_escape_string($_POST['linkedin']);
    $github     = $query->link->real_escape_string($_POST['github']);
    if (empty($facebook) || empty($twitter) || empty($linkedin) || empty($github)) {
        echo "<span class='error'>Field must not be empty</span>";
    } else {
        $updateSql = "UPDATE social_links SET facebook='$facebook',twitter='$twitter',linkedin='$linkedin',github='$github' WHERE id=1";
        $response  = $query->update($updateSql);
        if ($response) {
            echo "<span class='success'>Updated successfully</span>";
        }
    }
}


?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input value="<?= $socail_links['facebook'] ?>" type="text" name="facebook" placeholder="Facebook link.." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Twitter</label>
                        </td>
                        <td>
                            <input value="<?= $socail_links['twitter'] ?>" type="text" name="twitter" placeholder="Twitter link.." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input value="<?= $socail_links['linkedin'] ?>" type="text" name="linkedin" placeholder="LinkedIn link.." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Github</label>
                        </td>
                        <td>
                            <input value="<?= $socail_links['github'] ?>" type="text" name="github" placeholder="Github link.." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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