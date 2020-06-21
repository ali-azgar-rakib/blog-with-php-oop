<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}

$userSql    = "SELECT * FROM users ORDER BY roleid,id DESC";
$users      = $query->select($userSql);

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Users List</h2>

        <!-- category delete code  -->
        <?php

        if (isset($_GET['action']) && $_GET['id'] != null) {
            $deleteId       = base64_decode($_GET['id']);
            $result         = $query->delete('users', $deleteId);
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $serial = 1;
                    foreach ($users as $user) {
                    ?>
                        <tr class="odd gradeX">
                            <td><?= $serial++ ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['roleid'] == 1 ? 'Admin' : 'Author' ?></td>
                            <td><a href="edit_category.php?id=<?= base64_encode($category['id']) ?>">Edit</a> || <a onclick="return confirm('are you sure to Delete ?')" href="?action=delete&id=<?= base64_encode($user['id']) ?>">Delete</a></td>
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