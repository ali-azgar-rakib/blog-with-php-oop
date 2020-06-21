<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


// delete page code start here 

if (isset($_GET['action']) && $_GET['id'] != null) {
    $deleteId   = base64_decode($_GET['id']);
    $response = $query->delete('pages', $deleteId);
    if ($response) {
        echo "<span class='error'>Field should not be empty</span>";
        header('location: index.php');
    }
}







// page data from db 

if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('location: index.php');
}
$pageId = $_GET['id'];
$pageDataSql = "SELECT * FROM pages WHERE id=$pageId";
$pageDataQuery = $query->select($pageDataSql);
$pageData       = $pageDataQuery->fetch_assoc();



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
                $pageUpdateSql      = "UPDATE pages SET title = '$title',content='$content' WHERE id=$pageId";
                $response           = $query->insert($pageUpdateSql);
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
                            <input value="<?= $pageData['title'] ?>" name='title' type="text" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name='content'><?= $pageData['content'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <span style="margin-left: 10px;"><a style="	
                                border: 1px solid #ddd;
                                color: #444;
                                cursor: pointer;
                                font-size: 20px;
                                padding: 2px 10px;
                                background: #e8e8e7;
                                " href="?action=delete&id=<?= base64_encode($pageData['id']) ?>">
                                    Delete Page</a></span>
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