+<?php
include_once 'database/databae.php';

global $db;

$errorCategory = "";
$errorMerk = "";
$errorType = "";
$errorMemory = "";
$errorHd = "";
$errorPrijs = "";

if (isset($_POST["send"])) {
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $merk = filter_input(INPUT_POST, 'merk', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $memory = filter_input(INPUT_POST, 'memory', FILTER_SANITIZE_SPECIAL_CHARS);
    $hd = filter_input(INPUT_POST, 'hd', FILTER_SANITIZE_SPECIAL_CHARS);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_VALIDATE_FLOAT);

    if (empty($category)) {
        $errorCategory = "Category invullen";
    }
    if (empty($merk)) {
        $errorMerk = "Merk invullen";
    }
    if (empty($type)) {
        $errorType = "Type Invullen";
    }
    if (empty($memory)) {
        $errorMemory = "Memory Invullen";
    }
    if (empty($hd)) {
        $errorHd = "HD Invullen";
    }
    if ($prijs === false) {
        $errorPrijs = "Prijs invullen";
    }
    if ($errorCategory == "" && $errorMerk == "" && $errorType == "" && $errorMemory == "" && $errorHd == "" && $errorPrijs == "") {
        $query = $db->prepare("INSERT INTO laptops (category,merk,type,memory,hd,prijs) VALUES(:category,:merk,:type,:memory,:hd,:prijs) ");
        $query->bindParam(':category', $category);
        $query->bindParam(':merk', $merk);
        $query->bindParam(':type', $type);
        $query->bindParam(':memory', $memory);
        $query->bindParam(':hd', $hd);
        $query->bindParam(':prijs', $prijs);
        $query->execute();
        header("location:read.php");
    }
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
    <title>Document</title></head>
<body>
<div class="container">
    <h1>Insert laptop</h1>
    <form method="post">
        <div class="container">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    <option selected>Open this select menu</option>
                    <option value="Ultrabooks">Ultrabooks</option>
                    <option value="Gaming">Gaming Laptops</option>
                    <option value="Chromebooks">Chromebooks</option>
                    <option value="2-in-1 Laptops">2-in-1 Laptops</option>
                    <option value="Zakelijke Laptops">Zakelijke Laptops</option>
                </select>
                <?= $errorCategory ?><br>
            </div>
            <div class="mb-3">
                <label class="form-label">merk</label>
                <input class="form-control" type="text" name="merk" value="<?= $_POST['merk'] ?? '' ?>"><br>
                <?= $errorMerk ?><br>
            </div>
            <div class="mb-3">
                <label class="form-label">type</label>
                <input class="form-control" type="text" name="type" value="<?= $_POST['type'] ?? '' ?>"><br>
                <?= $errorType ?><br>
            </div>
            <div class="mb-3">
                <label class="form-label">Memory</label>
                <input class="form-control" type="text" name="memory" value="<?= $_POST['memory'] ?? '' ?>"><br>
                <?= $errorMemory ?><br>
            </div>
            <div class="mb-3">
                <label class="form-label">HD</label>
                <input class="form-control" type="text" name="hd" value="<?= $_POST['hd'] ?? '' ?>"><br>
                <?= $errorHd ?><br>
            </div>
            <div class="mb-3">
                <label class="form-label">prijs</label>
                <input class="form-control" type="text" name="prijs" value="<?= $_POST['prijs'] ?? '' ?>"><br>
                <?= $errorPrijs ?><br>
            </div>
            <input type="submit" name="send"  class="btn btn-primary" value="insert">
            <a href="read.php" class="btn btn-primary">back</a>
        </div>
    </form>
    <br>

</div>
</body>
</html>
