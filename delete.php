<?php
include_once 'module/databae.php';


global $db;
$sth = $db->prepare('SELECT * FROM cars WHERE id=? ');
$sth->bindParam(1, $_GET['id']);
$sth->execute();
$sth->setFetchMode(PDO::FETCH_ASSOC);
$car=$sth->fetch();

if(isset($_POST['submit'])) {
    $sth=$db->prepare('DELETE FROM cars WHERE id=:id');
    $sth->bindParam(':id',$_GET['id']);
    $sth->execute();
    header('Location:read.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars4u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <h1>Verwijder de volgende rij?</h1>
    <form method="post">
        <table class="table">
            <thead>
            <th>id</th>
            <th>merk</th>
            <th>type</th>
            <th>kilometerstand</th>
            <th>kleur</th>
            <th>prijs</th>
            </thead>
            <tbody>
            <tr>
                <td><?= $car['id'] ?></td>
                <td><?= $car['merk']?></td>
                <td><?= $car['type']?></td>
                <td><?=$car['kilometerstand']?></td>
                <td><?=$car['kleur']?></td>
                <td><?=$car['prijs']?></td>
            </tr>
            </tbody>
        </table>

        <input type="submit" class="btn btn-primary" name="submit" value="delete">
        <a href="read.php" class="btn btn-primary">back</a>
    </form>
</div>
</body>
</html>
