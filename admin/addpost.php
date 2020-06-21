<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";

?>


<div class="grid_10">

    <div class="box round first grid">

        <!-- php code for add post start here  -->
        <?php

        if (isset($_POST['submit'])) {
            $title          = $query->link->real_escape_string($_POST['title']);
            $category_id    = $query->link->real_escape_string($_POST['select']);
            $body           = $query->link->real_escape_string($_POST['body']);
            $author         = Session::get('loginid');
            $tags           = $query->link->real_escape_string($_POST['tags']);
            if (empty($title) || empty($category_id || empty($body) || empty($author) || empty($tags))) {
                echo "<span class='error'>Field must be not empty </span>";
            } else {
                $image              = $_FILES['image'];
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
                    if (move_uploaded_file($image_tmp_name, $image_final_name)) {;
                        $insertSql = "INSERT INTO posts(category_id, title, body, image, author, tags) VALUES ($category_id,'$title','$body','$image_final_name',$author,'$tags')";
                        $result    = $query->insert($insertSql);
                        if ($result) {
                            echo "<span class='success'>Post added successfully!</span>";
                        }
                    }
                }
            }
        }

        ?>

        <!-- php code for add post end here  -->






        <h2>Add New Post</h2>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input value="<?= isset($title) ? $title : '' ?>" name='title' type="text"
                                placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="select">
                                <option selected disabled>Select Category</option>

                                <!-- php code from read category from database  -->

                                <?php
                                $categories = $query->readAll('categories');
                                foreach ($categories as $category) {

                                ?>

                                <!-- php code from read category from database  -->


                                <option <?= isset($category_id) && $category_id == $category['id'] ? 'selected' : '' ?>
                                    value="<?= $category['id'] ?>"><?= $category['category'] ?></option>

                                <!-- forecah for category end here  -->
                                <?php } ?>

                            </select>
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
                            <textarea class="tinymce" name='body'>
                                <?= isset($body) ? $body : '' ?>
                            </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input value="<?= isset($tags) ? $tags : '' ?>" type="text" name='tags' />
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

?>