<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


?>


<div class="grid_10">

    <div class="box round first grid">

        <!-- php code for add page start here  -->

        <?php

        if (isset($_POST['submit'])) {
            $title      = $query->link->real_escape_string($_POST['title']);
            $content    = $query->link->real_escape_string($_POST['content']);

            if (empty($title) || empty($content)) {
                echo "<span class='error'>Field should not be empty</span>";
            } else {
                $pageInserSql   = "INSERT INTO pages(title,content) VALUES('$title','$content')";
                $response       = $query->insert($pageInserSql);
                if ($response) {
                    echo "<span class='success'>Page added successfully</span>";
                }
            }
        }


        ?>


        <!-- php code for add page end here  -->


        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input name='title' type="text" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name='content'></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Add Page" />
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

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>


<?php

require_once "inc/footer.php";

?>