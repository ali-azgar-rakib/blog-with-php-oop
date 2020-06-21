<?php
require_once "inc/header.php";
require_once "inc/slider.php";

?>




</div>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php

		// paginator
		$per_page_post = 5;
		if (isset($_GET['index'])) {
			$page = $_GET['index'];
		} else {
			$page = 1;
		}
		$start_from = ($page - 1) * $per_page_post;

		$sql = "SELECT * FROM posts LIMIT $start_from,$per_page_post";
		$posts = $query->select($sql);

		if ($posts) {

			foreach ($posts as $post) {
		?>
        <div class="samepost clear">
            <h2><a href="post.php?id=<?= $post['id'] ?>"> <?= $post['title'] ?> </a></h2>
            <h4> <?php echo Helpers::formatDate($post['time']); ?> <a href="#"><?= $post['author'] ?></a></h4>
            <a href="#"><img src="admin/<?= $post['image'] ?>" alt="post image" /></a>
            <p><?= Helpers::shortText(html_entity_decode($post['body'])) ?></p>
            <div class="readmore clear">
                <a href="post.php?id=<?= $post['id'] ?>">Read More</a>
            </div>
        </div>

        <?php
			} ?>
        <!-- paginator -->

        <?php
			$paginatorQuery = "SELECT * FROM posts";
			$posts = $query->select($paginatorQuery);
			$total_rows = ceil($posts->num_rows / $per_page_post);

			for ($i = 1; $i <= $total_rows; $i++) {
			?>

        <span class='paginator'><a href="index.php?index=<?= $i ?>"><?= $i ?></a></span>

        <?php
			}

			?>

        <?php
		}
		?>

    </div>
    <?php
	require_once "inc/sidebar.php";

	?>
</div>

<?php require_once "inc/footer.php"; ?>