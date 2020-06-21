<?php
require_once "inc/header.php";
if (!isset($_GET['id']) || $_GET['id'] == null) {
	header('location: 404.php');
}
$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $query->select($sql);
$post = $result->fetch_assoc();

?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2><?= $post['title'] ?></h2>
            <h4><?= Helpers::formatDate($post['time']) ?>, By Delowar</h4>
            <img src="admin/<?= $post['image'] ?>" alt="MyImage" />
            <p><?= html_entity_decode($post['body']) ?></p>

            <div class="relatedpost clear">
                <h2>Related articles</h2>
                <?php
				$category_id = $post['category_id'];
				$reletedSql = "SELECT * FROM posts WHERE category_id = $category_id ORDER BY RAND() LIMIT 3";
				$reletedResult = $query->select($reletedSql);
				foreach ($reletedResult as $reletedPost) {
					if ($id == $reletedPost['id']) {
						continue;
					}

				?>

                <a href="post.php?id=<?= $reletedPost['id'] ?>"><img src="admin/<?= $reletedPost['image'] ?>"
                        alt="post image" /></a>

                <?php
				}

				?>
            </div>
        </div>

    </div>
    <?php
	require_once "inc/sidebar.php";
	?>
</div>

<?php require_once "inc/footer.php"; ?>