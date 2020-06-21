<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// post delete code start here 

if (isset($_GET['author']) && isset($_GET['id'])) {

    if (Session::get('loginid') == base64_decode($_GET['author']) || Session::get('roleid') == 1) {
        $deleteId = base64_decode($_GET['id']);
        $getDataSql = "SELECT * FROM posts WHERE id=$deleteId";
        $getData    = $query->select($getDataSql);
        $deleteData = $getData->fetch_assoc();
        unlink($deleteData['image']);



        $deleteStatus = $query->delete('posts', $deleteId);
        if ($deleteStatus) {
            echo "<script> alert('Delete successfully')</script>";
        }
    } else {
        header('location: postlist.php');
    }
}


// post delete code end here 



?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Post Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- code for all posts start here  -->
                    <?php
                    $index = 1;
                    $posts = $query->readAll('posts');
                    foreach ($posts as $post) {
                    ?>

                    <!-- code for all posts start here  -->


                    <tr class="odd gradeX">
                        <td><?= $index++ ?></td>
                        <td><?= $post['title'] ?></td>
                        <td><?= Helpers::shortText($post['body'], 50) ?></td>
                        <td><?= $post['category_id'] ?></td>
                        <td><?= $post['author'] ?></td>
                        <td>
                            <!-- role base access control  -->
                            <?php

                                if (Session::get('loginid') == $post['author'] || Session::get('roleid') == 1) {
                                ?>

                            <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a> || <a
                                onclick="return confirm('are you sure you want to delete this?')"
                                href=" ?author=<?= base64_encode($post['author']) ?>&id=<?= base64_encode($post['id']) ?>">Delete</a>
                        </td>

                        <?php } ?>
                    </tr>

                    <!-- all posts foreach end here  -->
                    <?php } ?>


                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php

require_once "inc/footer.php";

?>