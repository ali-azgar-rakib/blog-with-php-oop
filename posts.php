<?php
require_once "inc/header.php";
require_once "inc/slider.php";
if (!isset($_GET['category']) || $_GET['category'] == null) {
    header('location: 404.php');
}
$per_page_post = 5;
if (isset($_GET['index']) && $_GET['index'] != null) {
    $page = $_GET['index'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page_post;
?>




</div>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $category = $_GET['category'];
        $category_posts_sql = "SELECT * FROM posts WHERE category_id = $category LIMIT $start_from,$per_page_post";
        if ($query->select($category_posts_sql)) {
            foreach ($query->select($category_posts_sql) as $category_post) {

        ?>


        <div class="samepost clear">
            <h2><a href="post.php?id=<?= $category_post['id'] ?>"> <?= $category_post['title'] ?> </a></h2>
            <h4> <?php echo Helpers::formatDate($category_post['time']); ?> <a
                    href="#"><?= $category_post['author'] ?></a></h4>
            <a href="#"><img src="admin/<?= $category_post['image'] ?>" alt="post image" /></a>
            <p><?= Helpers::shortText(html_entity_decode($category_post['body'])) ?></p>
            <div class="readmore clear">
                <a href="post.php?id=<?= $category_post['id'] ?>">Read More</a>
            </div>
        </div>
        <?php }
        } else {
            echo 'No Post Found';
        } ?>

        <!-- paginator -->
        <?php
        $paginatorSql = "SELECT * FROM posts WHERE category_id = $category";
        $result = $query->select($paginatorSql);
        if ($result) {
            $total_rows = ceil($result->num_rows / $per_page_post);
            for ($i = 1; $i <= $total_rows; $i++) {
        ?>
        <span class='paginator'><a href="?category=<?= $category ?>&index=<?= $i ?>"> <?= $i ?> </a></span>
        <?php
            }
        }
        ?>






    </div>
    <?php
    require_once "inc/sidebar.php";

    ?>
</div>

<?php require_once "inc/footer.php"; ?>