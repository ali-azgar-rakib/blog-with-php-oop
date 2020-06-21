<?php
ob_start();
require_once "inc/header.php";
require_once "inc/sidebar.php";

// check admin or not 
if (Session::get('roleid') != 1) {
    header('location: index.php');
}


if (!isset($_GET['messageid'])) {
    header('location: inbox.php');
}
$messageId      = $_GET['messageid'];
$messageSql     = "SELECT * FROM messages WHERE id=$messageId";
$messageQuery   = $query->select($messageSql);
$message        = $messageQuery->fetch_assoc();

// mark as read code 
if ($message) {
    $markAsReadSql = "UPDATE messages SET status = 0 WHERE id=$messageId";
    $markAsReadQueary = $query->update($markAsReadSql);
} else {
    header('location: 404.php');
}

// return back 
if (isset($_POST['submit'])) {
    header('location: inbox.php');
}


?>


<div class="grid_10">

    <div class="box round first grid">


        <h2>Message</h2>
        <div class="block">
            <form action="" method="post">
                <table class="form">

                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?= $message['name'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?= Helpers::formatDate($message['time']) ?>"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea readonly><?= $message['message'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Back" />
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