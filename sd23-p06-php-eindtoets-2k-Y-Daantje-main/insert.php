<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=laptop4u",
        "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

$id = $_GET['id'];

$query = $db->prepare("SELECT * FROM laptops WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();
$result = $query->fetchAll(PDO:: FETCH_ASSOC);

$errorCatagory = "";
$errorMerk = "";
$errorType = "";
$errorMemory = "";
$errorPrijs = "";
$errorHD = "";


if (isset($_POST["send"])) {
    $Memory = filter_input(INPUT_POST, 'memory', FILTER_SANITIZE_SPECIAL_CHARS);
    $merk = filter_input(INPUT_POST, 'merk', FILTER_SANITIZE_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_SPECIAL_CHARS);
    $catagory = filter_input(INPUT_POST, 'catagory', FILTER_SANITIZE_SPECIAL_CHARS);
    $HD = filter_input(INPUT_POST, 'hd', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($HD)) {
        $errorHD = "HD invullen";
    }
    if (empty($merk)) {
        $errorMerk = "Voledige merk Invullen";
    }
    if (empty($type)) {
        $errorType = "Type Invullen";
    }
    if (empty($prijs)) {
        $errorPrijs = "Prijs Invullen";
    }
    if (empty($Memory)) {
        $errorMemory = "Memory kiezen";
    }
    if (empty($Category)) {
        $errorCatagory = "Catagory kiezen";
    }

    $merk = filter_input(INPUT_POST, 'merk', FILTER_SANITIZE_SPECIAL_CHARS);
    $data['merk'] = $merk;

    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_SPECIAL_CHARS);
    $data['prijs'] = $prijs;

    $Memory = filter_input(INPUT_POST, 'Memory', FILTER_SANITIZE_SPECIAL_CHARS);
    $data['Memory'] = $Memory;

    $HD = filter_input(INPUT_POST, 'Hd', FILTER_SANITIZE_SPECIAL_CHARS);
    $data['Hd'] = $HD;


    if ($errorCatagory == "" && $errorMerk == "" && $errorType == "" && $errorPrijs == "" && $errorCatagory == "" && $errorMemory == "" && $errorHD == "") {
        $query = $db->prepare("UPDATE product SET Catagory = :Catagory, Merk = :Merk, prijs = :prijs, Memory = :memory, Type = :Type WHERE id = :id");
        $query->bindParam(':catagory', $Catagory);
        $query->bindParam(':merk', $Merk);
        $query->bindParam(':type', $Type);
        $query->bindParam(':prijs', $prijs);
        $query->bindParam(':hd', $HD);
        $query->bindParam(':memory', $Memory);
//        $query->bindParam(':id', $id);
        $query->execute();
        header("location:read.php");
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Update laptops</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5 mb-5">
    <form method="post" action="">
        <div class="pt-4">
            <?php foreach ($result

            as $data): ?>
            <h1 class="head-text">laptop Update</h1>
            <div>
                <h4 class="head-text">Catagory</h4>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <select class="form-select" aria-label="Default select example" id="catagory"
                                name="catagory">
                            <option selected value="<?= $data ['catagory'] ?>">Open this select menu</option>
                            <option value="1"></option>
                            <option value="2"></option>
                        </select>
                        <div class="head-text text-danger"> <?= $errorCatagory ?></div>
                        <br>
                    </div>
                </div>
            </div>

            <hr>
            <div class="mb-4">
                <h4 class="head-text">merk</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="merk" class="form-label head-text">merk</label>
                        <input type="text" class="form-control" id="merk" name="name"
                               value="<?= $data ['merk'] ?>">
                        <div class="head-text text-danger"> <?= $errorMerk ?></div>
                        <br>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="head-text">type</h4>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label for="type" class="form-label head-text">type</label>
                        <textarea class="form-control" id="type" name="discription" rows="10"
                                  cols="30"><?= htmlspecialchars($data["type"]) ?></textarea>
                        <div class="head-text text-danger"> <?= $errorType ?></div>
                        <br>
                    </div>
                    <h4 class="head-text">memory</h4>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="memory" class="form-label head-text">memory</label>
                            <textarea class="form-control" id="memory" name="discription" rows="10"
                                      cols="30"><?= htmlspecialchars($data["memory"]) ?></textarea>
                            <div class="head-text text-danger"> <?= $errorMemory ?></div>
                            <br>
                        </div>
                        <h4 class="head-text">hd</h4>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label for="hd" class="form-label head-text">hd</label>
                                <textarea class="form-control" id="hd" name="hd" rows="10"
                                          cols="30"><?= htmlspecialchars($data["hd"]) ?></textarea>
                                <div class="head-text text-danger"> <?= $errorHD ?></div>
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
                    <?php endforeach; ?>
                </div>
                <button class="btn btn-primary" type="submit" name="send" value="Updaten">insert</button>
    </form>
</div>
</body>
</html>