<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            <?php
            $categories = "SELECT * FROM categories";
            foreach ($query->select($categories) as $category) {

            ?>
            <li><a href="posts.php?category=<?= $category['id'] ?>"><?= $category['category'] ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>

        <?php
        $latestPostSql = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
        if ($query->select($latestPostSql)) {
            foreach ($query->select($latestPostSql) as $latestPost) {

        ?>

        <div class="popular clear">
            <h3><a href="post.php?id=<?= $latestPost['id'] ?>"><?= $latestPost['title'] ?></a></h3>
            <a href="#"><img src="admin/<?= $latestPost['image'] ?>" alt="post image" /></a>
            <p><?= Helpers::shortText(html_entity_decode($latestPost['body']), 100) ?></p>
        </div>
        <?php }
        } else {
            echo 'No Post To Show';
        } ?>


    </div>

</div>