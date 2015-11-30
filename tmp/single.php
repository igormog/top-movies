<?php

require('src/connect_db.php');

$notice = isset($notice) ? $notice : null;

# Save film
if (isset($_POST['submit'])) {
    $name_film = mysqli_real_escape_string($connect, $_POST['name_film']);
    $year_film = mysqli_real_escape_string($connect, $_POST['year_film']);
    $is_active = mysqli_real_escape_string($connect, htmlspecialchars($_POST['is_active']));
    if (empty($name_film)) {
        $notice = 'You have not entered the film\'s title.';
    } else if (empty($year_film)) {
        $notice = 'You have not entered the year the film.';
    } else {
        if ($is_active !== '0') $is_active = 1;
        $data_add = date('d-m-Y');

        $sql = "INSERT INTO ".TBLNAME." (name_film, year_film, isActive, data_add)
            VALUES ('$name_film', '$year_film', $is_active, '$data_add')";
        $query = mysqli_query($connect, $sql);
        if (!$query) {
            $notice = 'Error!' . mysqli_error();
        } else {
            Header("Location: {$_SERVER['SCRIPT_NAME']}");
            exit();
        }
    }
}

# SELECT All Film
$sql = "SELECT *
    FROM ".TBLNAME."
    ORDER BY id DESC";

$query = mysqli_query($connect, $sql);
if (!$query) {
    $notice = 'Error' . mysqli_error();
}
$all_lines = mysqli_num_rows($query);
?>

<?= $notice ?>

<div class="container">
    <form method="post" action="" class="form-signin">
        <h2 class="form-signin-heading">Please added film</h2>
        <input type="text" name="name_film" placeholder="Name film" class="form-control"><br/>
        <input type="text" name="year_film" placeholder="Year film" class="form-control"><br/>
        <div class="checkbox">
            <label>
            <input type="checkbox" name="is_active" value="0"> Not public
            </label>
        </div>
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Отправить"/>
    </form>
</div>

<div class="container added">
    <h3>All added films</h3>
    <div class="row">
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-4"><?=$row['name_film'] ?></div>
        <div class="col-md-4"><?=$row['year_film'] ?></div>
        <div class="col-md-4"><?=$row['data_add'] ?></div>
    <?php endwhile; ?>
    </div>
</div>

