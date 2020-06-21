<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";

if (Session::get('roleid') != 1) {
    header('location: index.php');
}


$categorySql = "SELECT * FROM categories ORDER BY id DESC";
$categories = $query->select($categorySql);

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

        <!-- category delete code  -->
        <?php

        if (isset($_GET['action']) && $_GET['id'] != null) {
            $deleteId = base64_decode($_GET['id']);
            $result = $query->delete('categories', $deleteId);
            if ($result == true) {
            }
        }

        ?>


        <!-- category delete code  -->


        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $serial = 1;
                    foreach ($categories as $category) {
                    ?>
                    <tr class="odd gradeX">
                        <td><?= $serial++ ?></td>
                        <td><?= $category['category'] ?></td>
                        <td><a href="edit_category.php?id=<?= base64_encode($category['id']) ?>">Edit</a> || <a
                                onclick="return confirm('are you sure to Delete ?')"
                                href="?action=delete&id=<?= base64_encode($category['id']) ?>">Delete</a></td>
                    </tr>

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

<!-- datatable -->
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