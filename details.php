<?php
include 'module/databae.php';
global $db;
$id=$_GET['id'];
$query = $db->prepare("SELECT * FROM cars WHERE id=:id");
$query -> bindParam(":id",$id);
$query->execute();
$cars = $query->fetchAll( PDO::FETCH_ASSOC);
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

<?php foreach ($cars as $car):?>
    <div class="card " style="width: 25rem;">
        <h3>Artikelnummer: <?=$car ['id'] ?></h3>
        <h3>Merk:</h3>
        <p class="mb-2"><?=$car ['merk'] ?></p>
        <h3>Type:</h3>
        <p class="mb-2"><?=$car ['type'] ?></p>
        <h3>Kilometerstand:</h3>
        <p class="mb-2"><?=$car ['kilometerstand'] ?></p>
        <h3>Kleur:</h3>
        <p class="mb-2"><?=$car ['kleur'] ?></p>
        <h3>Prijs:</h3>
        <p class="mb-2"><?=$car ['prijs'] ?></p>
    </div>
<?php endforeach; ?>
<a href="read.php">Terug naar home pagina</a>
<br>
