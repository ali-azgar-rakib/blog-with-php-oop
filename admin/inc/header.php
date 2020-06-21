<?php
require_once "../lib/Session.php";
Session::checkLogin();
require_once "../config/config.php";
require_once "../lib/Database.php";
require_once "../helpers/Helpers.php";
$query = new Database();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
    </script>

</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>Demo Title</h1>
                    <p></p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?= Session::get('name') != null ? Session::get('name') : '' ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="user_profile.php"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>

                <!-- new message notification  -->
                <?php
                if (Session::get('roleid') == 1) {
                    $notificationSql    = "SELECT * FROM messages WHERE status=1";
                    $notification       = $query->select($notificationSql);
                ?>

                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox(<?= $notification->num_rows ?>)</span></a>
                </li>
                <li class="ic-charts"><a href="add_user.php"><span>Add User</span></a></li>
                <li class="ic-face"><a href="user_list.php"><span>User List</span></a></li>

                <!-- if end bracket  -->
                <?php } ?>

                <li class="ic-charts"><a target="_blank" href="../index.php"><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>