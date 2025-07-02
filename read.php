<!doctype html>
<?php
include_once 'module/databae.php';
global $db;

$cars=$db->query("SELECT * FROM cars")->fetchAll(PDO::FETCH_ASSOC);

?>
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
    <h1>Cars CRUD</h1>
    <table class="table">
        <thead>
        <th>merk</th>
        <th>type</th>
        <th>details</th>
        <th>update</th>
        <th>delete</th>
        </thead>
        <tbody>

        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?=$car['merk']?></td>
                <td><?=$car['type']?></td>
                <td><a href="detail.php?id=<?=$car['id']?>">details</a></td>
                <td><a href="update.php?id=<?=$car['id']?>">update</a></td>
                <td><a href="delete.php?id=<?=$car['id']?>">delete</a></td>
            </tr>
        <?php endforeach;?>

        </tbody>
    </table>
    <a href="insert.php">insert</a>
</div>
</body>
</html>