<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>

    <!-- copyright from database  code start here -->

    <?php
    $copyrightQuery = $query->readAll('copyright');
    $copyrightData  = $copyrightQuery->fetch_assoc();
    ?>
    <!-- copyright from database  code end here -->

    <p>&copy; <?= $copyrightData['copyright'] ?></p>
</div>
<div class="fixedicon clear">
    <a href="<?= $socail_links['facebook'] ?>"><img src="images/fb.png" alt="Facebook" /></a>
    <a href="<?= $socail_links['twitter'] ?>"><img src="images/tw.png" alt="Twitter" /></a>
    <a href="<?= $socail_links['linkedin'] ?>"><img src="images/in.png" alt="LinkedIn" /></a>
    <a href="<?= $socail_links['github'] ?>"><img src="images/gl.png" alt="GooglePlus" /></a>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>