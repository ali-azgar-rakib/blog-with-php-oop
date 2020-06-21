<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


// data from database 

$copyrightQuery = $query->readAll('copyright');
$copyrightData  = $copyrightQuery->fetch_assoc();


// copyright update code start here 
if (isset($_POST['submit'])) {
    $copyright = $_POST['copyright'];
    if (empty($copyright)) {
        echo "<span class='error'>Field must not be empty</span>";
    } else {
        $updateSql = "UPDATE copyright SET copyright='$copyright'";
        $response  = $query->update($updateSql);
        if ($response) {
            echo "<span class='success'>Updated successfully!</span>";
        }
    }
}




?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">
            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td>
                            <input value="<?= $copyrightData['copyright'] ?>" type="text"
                                placeholder="Enter Copyright Text..." name="copyright" class="large" />
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