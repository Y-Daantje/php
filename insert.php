<?php
include_once 'module/databae.php';

const VENDOR_REQUIRED='Merk invullen';
const TYPE_REQUIRED='Type invullen';
const KM_REQUIRED='Kilometerstand invullen (geheel getal)';
const COLOR_REQUIRED='Kleur invullen';
const PRICE_REQUIRED='Prijs invullen (geheel getal)';

$vendorError="";
$typeError="";
$kmError="";
$colorError="";
$priceError="";


if(isset($_POST['submit'])) {

    //sanitize en validate merk
    $vendor=filter_input(INPUT_POST,'vendor',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(empty($vendor)){
        $vendorError=VENDOR_REQUIRED;
    }

    //sanitize en validate type
    $type=filter_input(INPUT_POST,'type',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(empty($type)){
        $typeError=TYPE_REQUIRED;
    }

    //sanitize en validate kilometerstand
    $km=filter_input(INPUT_POST,'km',FILTER_VALIDATE_INT);
    if(empty($km)){
        $kmError=KM_REQUIRED;
    }

    //sanitize en validate kleur (naam input element kleur geen color, deze wordt door filter_input gesanitized
    $color=filter_input(INPUT_POST,'kleur',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if(empty($color)){
        $colorError=COLOR_REQUIRED;
    }

    //sanitize en validate float
    $price=filter_input(INPUT_POST,'price',FILTER_VALIDATE_FLOAT);
    echo $price;
    if(empty($price)){
        $priceError=PRICE_REQUIRED;
    }

    if($vendorError==="" && $typeError==="" && $kmError==="" && $colorError==="" && $priceError==="")
    {
        global $db;
        $sth=$db->prepare('INSERT INTO cars (merk,type,kilometerstand,kleur,prijs) VALUES 
                                                            (:vendor,:type,:km,:color,:price)');
        $sth->bindParam(':vendor', $vendor);
        $sth->bindParam(':type', $type);
        $sth->bindParam(':km', $km);
        $sth->bindParam(':color', $color);
        $sth->bindParam(':price', $price);

        $result=$sth->execute();
        header('Location:read.php');
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
    <title>Cars4u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <h1>Insert car</h1>
    <form method="post">

        <div class="mb-3">
            <label for='l' class="form-label">Merk</label>
            <input type="text" id='l' class="form-control" name="vendor"
                   value="<?php echo $vendor ?? '' ?>">
            <div class="form-text text-danger"><?=$vendorError?></div>
        </div>

        <div class="mb-3">
            <label for='l' class="form-label">Type</label>
            <input type="text" id='l' class="form-control" name="type"
                   value="<?php echo $type?? '' ?>">
            <div class="form-text text-danger"><?=$typeError?></div>
        </div>

        <div class="mb-3">
            <label for='l' class="form-label">Kilometerstand</label>
            <input type="text" id='l' class="form-control" name="km"
                   value="<?php echo $km ?? '' ?>">
            <div class="form-text text-danger"><?=$kmError?></div>
        </div>

        <div class="mb-3">
            <label for='l' class="form-label">Kleur</label>
            <input type="text" id='l' class="form-control" name="kleur"
                   value="<?php echo $color?? '' ?>">
            <div class="form-text text-danger"><?=$colorError?></div>
        </div>

        <div class="mb-3">
            <label for='l' class="form-label">Prijs</label>
            <input type="text" id='l' class="form-control" name="price"
                   value="<?php echo $price?? '' ?>">
            <div class="form-text text-danger"><?=$priceError?></div>
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="insert">
        <a href="read.php" class="btn btn-primary">back</a>
    </form>
</div>
</body>
</html>
