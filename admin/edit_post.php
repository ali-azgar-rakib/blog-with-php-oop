<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

if (!isset($_GET['id'])) {
    header('location: postlist.php');
}
$postId      = $_GET['id'];
$postDataSql = "SELECT * FROM posts WHERE id = $postId";
$result      = $query->select($postDataSql);
$postData    = $result->fetch_assoc();
if (Session::get('loginid') == $postData['author'] || Session::get('roleid') == 1) {


?>


<div class="grid_10">

    <div class="box round first grid">

        <!-- php code for update post start here  -->
        <?php

            if (isset($_POST['submit'])) {
                $title       = $query->link->real_escape_string($_POST['title']);
                $category_id = $query->link->real_escape_string($_POST['select']);
                $body        = $query->link->real_escape_string($_POST['body']);
                $author      = $postData['author'];
                $tags        = $query->link->real_escape_string($_POST['tags']);
                if (empty($title) || empty($category_id || empty($body) || empty($author) || empty($tags))) {
                    echo "<span class='error'>Field must be not empty </span>";
                } else {
                    $image                  = $_FILES['image'];
                    if (empty($image['name'])) {
                        $image_final_name   = $postData['image'];
                    } else {
                        unlink($postData['image']);
                        $image_tmp_name     = $image['tmp_name'];
                        $image_size         = $image['size'];
                        $image_tmp          = explode('.', $image['name']);
                        $image_ext          = strtolower(end($image_tmp));
                        $image_unique_name  = substr(md5(time()), 0, 10) . '.' . $image_ext;
                        $image_final_name   = 'img/uploads/posts/' . $image_unique_name;
                        $permited           = ['jpg', 'png', 'jpeg'];
                        if ($image_size > 100000) {
                            echo "<span class='error'> Upload a image less than 1 MB </span>";
                        } elseif (!in_array($image_ext, $permited)) {
                            echo "<span class='error'>Image extension must be  </span>" . implode(',', $permited);
                        } else {
                            move_uploaded_file($image_tmp_name, $image_final_name);
                        }
                    }
                    $updateSql    = "UPDATE posts SET category_id = $category_id, title='$title', body='$body', image = '$image_final_name', author='$author', tags ='$tags' WHERE id=$postId";
                    $updateResult = $query->update($updateSql);
                    if ($updateResult) {
                        header('location: postlist.php?update=success');
                    }
                }
            }




            ?>

        <!-- php code for update post end here  -->






        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input name='title' type="text" placeholder="Enter Post Title..." class="medium"
                                value='<?= $postData['title'] ?>' />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="select">

                                <!-- php code from read category from database  -->

                                <?php
                                    $categories = $query->readAll('categories');
                                    foreach ($categories as $category) {

                                    ?>

                                <!-- php code from read category from database  -->


                                <option <?= $postData['category_id'] == $category['id'] ? 'selected' : '' ?>
                                    value="<?= $category['id'] ?>"><?= $category['category'] ?></option>

                                <!-- forecah for category end here  -->
                                <?php } ?>

                            </select>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <label for="">Current Image</label>
                        </td>
                        <td>
                            <img width="150" src="<?= $postData['image'] ?>" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name='image' />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name='body'><?= $postData['body'] ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>

                            <?php
                                $authorId       = $postData['author'];
                                $authorSql      = "SELECT * FROM users WHERE id=$authorId";
                                $authorQuery    = $query->select($authorSql);
                                $authorData     = $authorQuery->fetch_assoc();

                                ?>


                            <input readonly type="text" name='author' value='<?= $authorData['name'] ?>' />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name='tags' value='<?= $postData['tags'] ?>' />
                        </td>
                    </tr>



                    <tr>
                        <td></td>
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
} else {
    header('location:postlist.php');
}
?>