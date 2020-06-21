<?php
require_once "inc/header.php";
if (!isset($_GET['pageid'])) {
    header('location: 404.php');
}
$pageId             = $query->link->real_escape_string($_GET['pageid']);
$pageDataSql        = "SELECT * FROM pages WHERE id=$pageId";
$pageDataQuery      = $query->select($pageDataSql);
$pageData           = $pageDataQuery->fetch_assoc();


?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2><?= $pageData['title'] ?></h2>

            <p><?= html_entity_decode($pageData['content']) ?></p>

        </div>

    </div>
    <?php
    require_once "inc/sidebar.php";

    ?>
</div>

<?php require_once "inc/footer.php"; ?>