<?php
include_once 'module/databae.php';

global $db;

$query = $db->prepare("SELECT * FROM laptops WHERE id= :id");
$query->bindValue(':id',$_GET['id']);
$query->execute();
$laptops = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Laptop detail</h1>
    <table class="table">
        <tr>
            <th>category</th>
            <th>merk</th>
            <th>type</th>
            <th>memory</th>
            <th>hd</th>
            <th>prijs</th>
        </tr>
        <?php foreach ($laptops as $laptop):?>
            <tr>
                <td><?= $laptop['category'] ?></td>
                <td><?= $laptop['merk'] ?></td>
                <td><?= $laptop['type'] ?></td>
                <td><?= $laptop['memory'] ?></td>
                <td><?= $laptop['hd'] ?></td>
                <td><?= $laptop['prijs'] ?></td>
            </tr>
        <?php endforeach;?>
    </table>
    <a href="read.php" class="btn btn-primary">back</a>
</div>
</body>
</html>
