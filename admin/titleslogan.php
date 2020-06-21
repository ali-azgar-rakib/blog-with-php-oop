<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}

// data from database 

$titleQuery = $query->readAll('title');
$titleData = $titleQuery->fetch_assoc();

// update data 

if (isset($_POST['submit'])) {


    $title      = $query->link->real_escape_string($_POST['title']);
    $sub_title  = $query->link->real_escape_string($_POST['sub_title']);
    $logo       = $_FILES['logo'];
    if (empty($title) || empty($sub_title)) {
        echo "<span class='error'>Fields shouldn't be empty</span>";
    } else {
        if ($logo['name']) {
            unlink($titleData['logo']);
            $logo_tmp_name      = $logo['tmp_name'];
            $logo_size          = $logo['size'];
            $logo_ext_array     = explode('.', $logo['name']);
            $logo_ext           = strtolower(end($logo_ext_array));
            $logo_final_name    = "img/uploads/" . substr(md5(time()), 0, 15) . '.' . $logo_ext;
            $permited           = ['jpg', 'png', 'jpeg'];
            if ($logo_size > 100000) {
                echo "<span class='error'>Image size shoudn't not upto 1 MB</span>";
            } elseif (!in_array($logo_ext, $permited)) {
                echo "<span class='error'>image extension must be </span>" . implode(',', $permited);
            } else {
                move_uploaded_file($logo_tmp_name, $logo_final_name);
            }
        } else {
            $logo_final_name = $titleData['logo'];
        }
        $updateSql = "UPDATE title SET title = '$title',sub_title = '$sub_title',logo='$logo_final_name' WHERE id=1";
        $response  = $query->update($updateSql);
        if ($response) {
            echo "<span class='success'>Updated successfully</span>";
        }
    }
}


?>
<style lang="">
    .leftside {
        float: left;
        width: 70%;
    }

    .rightside {
        float: left;
        width: 20%;
    }

    .rightsid img {
        width: 150px;
    }
</style>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <div class="leftside">
                <form action='' method='post' enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input value="<?= $titleData['title'] ?>" type="text" placeholder="Enter Website Title..." name="title" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input value="<?= $titleData['sub_title'] ?>" type="text" placeholder="Enter Website Slogan..." name="sub_title" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name='logo' />
                            </td>
                        </tr>



                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="rightside">
                <img src="<?= $titleData['logo'] ?>" alt="logo">
            </div>
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