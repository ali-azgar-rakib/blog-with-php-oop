<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


if (isset($_GET['id']) && $_GET['id'] != null) {
    $id = base64_decode($_GET['id']);
    $editQuery = "SELECT * FROM categories WHERE id = $id";
    $result = $query->select($editQuery);
    $category = $result->fetch_assoc();
} else {
    header('location: catlist.php');
}

?>
<div class="grid_10">
    <div class="box round first grid">


        <h2>Update Category</h2>
        <div class="block copyblock">

            <!-- php code for add category  -->
            <?php

            if (isset($_POST['submit'])) {
                $category = $query->link->real_escape_string($_POST['category']);
                if (empty($category)) {
                    echo "<span class='error'> Field shoud not be empty </span>";
                } else {
                    $updateSql = "UPDATE categories SET category = '$category' WHERE id = $id";
                    $result = $query->update($updateSql);
                    if ($result) {
                        header('location: catlist.php');
                    } else {
                        echo "<span class='error'> Not update . something went wrong</span>";
                    }
                }
            }

            ?>



            <!-- php code for add category  -->






            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td>
                            <input name='category' type="text" placeholder="Enter Category Name..." class="medium"
                                value='<?= $category['category'] ?>' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
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