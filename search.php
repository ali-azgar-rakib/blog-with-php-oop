<?php
require_once "inc/header.php";
require_once "inc/slider.php";
if (!isset($_GET['search'])) {
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
        $search = $_GET['search'];
        $search_posts = "SELECT * FROM posts WHERE title LIKE '%$search%' OR body LIKE '%$search%' LIMIT $start_from,$per_page_post";
        if ($query->select($search_posts)) {
        ?>
        <span style="font-size: 20px;">Sear Result For <strong style="color: red;"><?= $search ?></strong></span>
        <br>
        <?php
            foreach ($query->select($search_posts) as $search_post) {

            ?>


        <div class="samepost clear">
            <h2><a href="post.php?id=<?= $search_post['id'] ?>"> <?= $search_post['title'] ?> </a></h2>
            <h4> <?php echo Helpers::formatDate($search_post['time']); ?> <a href="#"><?= $search_post['author'] ?></a>
            </h4>
            <a href="#"><img src="admin/<?= $search_post['image'] ?>" alt="post image" /></a>
            <p><?= Helpers::shortText(html_entity_decode($search_post['body'])) ?></p>
            <div class="readmore clear">
                <a href="post.php?id=<?= $search_post['id'] ?>">Read More</a>
            </div>
        </div>
        <?php }
        } else {
            echo 'No Post Found';
        } ?>

        <!-- paginator -->
        <?php
        $paginatorSql = "SELECT * FROM posts WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
        $result = $query->select($paginatorSql);
        if ($result) {
            $total_rows = ceil($result->num_rows / $per_page_post);
            for ($i = 1; $i <= $total_rows; $i++) {
        ?>
        <span class='paginator'><a href="?search=<?= $search ?>&index=<?= $i ?>"> <?= $i ?> </a></span>
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