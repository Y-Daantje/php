<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=laptop4u",
        "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
$query = $db->prepare("SELECT * FROM laptops");
$query->execute();

$laptops = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $_GET['id'];

$query = $db->prepare("SELECT * FROM product WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();
$result = $query->fetchAll(PDO:: FETCH_ASSOC);

$errormerk = "";
$errortype = "";
$errorPrijs = "";
$errorCatagory = "";
$errorHD = "";
$errorMemory = "";
$errors = [];

if (isset($_POST["send"])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $discription = filter_input(INPUT_POST, 'discription');
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_SPECIAL_CHARS);
    $catagory = filter_input(INPUT_POST, 'catagory', FILTER_SANITIZE_SPECIAL_CHARS);


    if (empty($discription)) $errorDiscription = "Discription Invullen";
    if (empty($prijs)) $errorPrijs = "Prijs Invullen";
    if (empty($catagory)) $errorCatagory = "Catagory kiezen";


    if ($errormerk == "" && $errorDiscription == "" && $errorPrijs == "" && $errorCatagory == "" && $errorMemory == "" && $errorHD == "" && $errortype == "") {
        $query = $db->prepare("UPDATE product SET
            merk = :merk, 
            discription = :discription, 
            prijs = :prijs, 
            catagory = :catagory, 
            mermory = :mermory,
            hd = :hd,
            WHERE id = :id");

        $query->bindParam(':name', $name);
        $query->bindParam(':discription', $discription);
        $query->bindParam(':prijs', $prijs);
        $query->bindParam(':catagory', $catagory);

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>

<body>
<header>
</header>

<main>
    <div class="container mt-5 mb-5">
        <form method="post" action="">
            <div class="pt-4">
                <?php foreach ($result as $data): ?>
                    <h1 class="head-text">laptop Update</h1>
                    <hr>
                    <div class="mb-4">
                        <h4 class="head-text">merk</h4>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="merk" class="form-label head-text">merk</label>
                                <input type="text" class="form-control" id="name" name="merk"
                                       value="<?= $data ['merk'] ?>">
                                <div class="head-text text-danger"> <?= $errormerk ?></div>
                                <br>

                            </div>
                        </div>
                    </div>
                    <!-- Personal Details -->
                    <div class="mb-4">
                        <h4 class="head-text">Discription</h4>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label for="discription" class="form-label head-text">Discription</label>
                                <textarea class="form-control" id="discription" name="discription" rows="10"
                                          cols="30"><?= ($data['discription']) ?></textarea>
                                <div class="head-text text-danger"> <?= $errorDiscription ?></div>
                                <br>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="prijs" class="form-label head-text">Prijs</label>
                                <input type="text" class="form-control" id="prijs" name="prijs"
                                       value="<?= $data ['prijs'] ?>">
                                <div class="head-text text-danger"> <?= $errorPrijs ?></div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!-- Catagory Section -->
                    <div>
                        <h4 class="head-text">Catagory</h4>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <select class="form-select" aria-label="Default select example" id="catagory_id"
                                        name="catagory_id">
                                    <option selected value="<?= $data ['catagory_id'] ?>">Open this select menu</option>
                                    <option value="1">t</option>
                                    <option value="2"></option>
                                </select>
                                <div class="head-text text-danger"> <?= $errorCatagory ?></div>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="btn btn-primary" type="submit" name="send" value="Updaten">Update</button>
        </form>
    </div>
</main>
</body>

</html>