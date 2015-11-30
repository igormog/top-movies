<?php
require('src/connect_db.php');
# All the films in which isActive = 1
$sql = "SELECT * FROM ".TBLNAME." WHERE isActive=1 ORDER BY id DESC";
$query = mysqli_query($connect, $sql) or die('Error connect Data base' . mysqli_error());
$all_films = mysqli_num_rows($query);
?>

<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">The My Films</h1>
        <p class="lead blog-description">The official example of creating a blog films.</p>
    </div>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title"><?= $row['name_film'] ?></h2>
                <p class="blog-post-meta"><?= $row['year_film'] ?></p>
                <p class="blog-post-meta">Films added <span style="font-size: 12px;"><?= $row['data_add'] ?></span></p>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <hr>
    <h4><span style="color: #666;">All films:</span> <?=$all_films?></h4>
</div>