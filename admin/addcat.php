<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


?>
<div class="grid_10">
    <div class="box round first grid">


        <h2>Add New Category</h2>
        <div class="block copyblock">

            <!-- php code for add category  -->
            <?php

            if (isset($_POST['submit'])) {
                $category = $query->link->real_escape_string($_POST['category']);
                if (empty($category)) {
                    echo "<span class='error'> Field shoud not be empty </span>";
                } else {
                    $insertSql = "INSERT INTO categories(category) VALUES('$category')";
                    $result = $query->insert($insertSql);
                    if ($result) {
                        echo "<span class='success'> Added Successfully!</span>";
                    } else {
                        echo "<span class='error'> Not added . something went wrong</span>";
                    }
                }
            }

            ?>



            <!-- php code for add category  -->






            <form action='' method='post'>
                <table class="form">
                    <tr>
                        <td>
                            <input name='category' type="text" placeholder="Enter Category Name..." class="medium" />
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