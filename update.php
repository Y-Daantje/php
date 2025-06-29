<?php
include_once 'database/databae.php';

global $db;

if (isset($_POST['send'])) {
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $merk = filter_input(INPUT_POST, 'merk', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $memory = filter_input(INPUT_POST, 'memory', FILTER_SANITIZE_SPECIAL_CHARS);
    $hd = filter_input(INPUT_POST, 'hd', FILTER_SANITIZE_SPECIAL_CHARS);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_VALIDATE_FLOAT);

    $query = $db->prepare("UPDATE laptops SET category=:category,merk=:merk,type=:type,memory=:memory,hd=:hd,prijs=:prijs WHERE id=:id");
    $query->bindParam(':category', $category);
    $query->bindParam(':merk', $merk);
    $query->bindParam(':type', $type);
    $query->bindParam(':memory', $memory);
    $query->bindParam(':hd', $hd);
    $query->bindParam(':prijs', $prijs);
    $query->execute();
    header("location:read.php");
} else {
    $query = $db->prepare("SELECT * FROM laptops WHERE id= :id");
    $query->bindValue(':id',$_GET['id']);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $category = $result['category'];
    $merk = $result['merk'];
    $type = $result['type'];
    $memory = $result['memory'];
    $hd= $result['hd'];
    $prijs = $result['prijs'];
}
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
    <h1>Update laptop</h1>
    <form method="post">
        <div class="container">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    <option selected><?=$category ?? ''?></option>
                    <option value="Ultrabooks">Ultrabooks</option>
                    <option value="Gaming">Gaming Laptops</option>
                    <option value="Chromebooks">Chromebooks</option>
                    <option value="2-in-1 Laptops">2-in-1 Laptops</option>
                    <option value="Zakelijke Laptops">Zakelijke Laptops</option>
                </select>

            </div>
            <div class="mb-3">
                <label class="form-label">merk</label>
                <input class="form-control" type="text" name="merk" value="<?=$merk ?? ''?>"><br>

            </div>
            <div class="mb-3">
                <label class="form-label">type</label>
                <input class="form-control" type="text" name="type" value="<?=$type ?? ''?>"><br>
            </div>
            <div class="mb-3">
                <label class="form-label">Memory</label>
                <input class="form-control" type="text" name="memory" value="<?=$memory ?? ''?>"><br>
            </div>
            <div class="mb-3">
                <label class="form-label">HD</label>
                <input class="form-control" type="text" name="hd" value="<?=$hd ?? ''?>"><br>

            </div>
            <div class="mb-3">
                <label class="form-label">prijs</label>
                <input class="form-control" type="text" name="prijs" value="<?=$prijs ?? ''?>"><br>

            </div>
            <input type="submit" name="send"  class="btn btn-primary" value="update">
            <a href="read.php" class="btn btn-primary">back</a>
        </div>
    </form>
    <br>

</div>
</body>
</html>
