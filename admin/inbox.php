<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


// message from db 

$messageSql             = "SELECT * FROM messages ORDER BY status DESC,id DESC";
$messages               = $query->select($messageSql);

// mark as read 

if (isset($_GET['seenid'])) {
    $seenId             = $_GET['seenid'];
    $markAsReadSql      = "UPDATE messages SET status = 0 WHERE id=$seenId";
    $markAsReadQueary   = $query->update($markAsReadSql);
}

// for message delete 
if (isset($_GET['action']) && $_GET['id'] != null) {
    $deleteId           = base64_decode($_GET['id']);
    $deleteStatus       = $query->delete('messages', $deleteId);
}

// success message variable set null 
if (isset($successMessage)) {
    $successMessage     = null;
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <!-- success message for delete  -->
            <?php

            if (isset($deleteStatus) && $deleteStatus != false) {
                $successMessage = "<span class='success'>Deleted successfully</span>";
                echo $successMessage;
            }

            ?>


            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- foreach for message data  -->
                    <?php
                    $index = 1;
                    foreach ($messages as $message) {

                    ?>

                        <tr style="<?= $message['status'] == 1 ? 'background-color:lightgrey;' : '' ?>" class="odd gradeX">
                            <td><?= $index++ ?></td>
                            <td><?= $message['name'] ?></td>
                            <td><?= Helpers::shortText($message['message'], 50) ?></td>
                            <td><?= Helpers::formatDate($message['time']) ?></td>
                            <td><a href="view_message.php?messageid=<?= $message['id'] ?>">View</a> || <a href="?seenid=<?= $message['id'] ?>">Mark as
                                    Read</a> || <a href="?action=delete&id=<?= base64_encode($message['id']) ?>">Delete</a>
                            </td>
                        </tr>
                        <!-- end foreach bracket  -->
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

<!-- Datatable -->
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