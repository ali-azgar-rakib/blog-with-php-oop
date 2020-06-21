        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">

                        <!-- role based access control  -->

                        <?php

                        if (Session::get('roleid') == 1) {

                        ?>

                        <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>

                            </ul>
                        </li>

                        <li><a class="menuitem">Pages</a>
                            <ul class="submenu">
                                <li><a href="add_page.php">Add New Page</a></li>

                                <!-- code for page start here -->
                                <?php
                                    $pagesQuery = $query->readAll('pages');
                                    foreach ($pagesQuery as $page) {
                                    ?>
                                <!-- code for page end here -->


                                <li><a href="page.php?id=<?= $page['id'] ?>">
                                        <?= $page['title'] ?></a></li>

                                <!-- foreach end bracket  -->
                                <?php } ?>

                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>

                        <!-- end if bracket  -->
                        <?php } ?>

                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>