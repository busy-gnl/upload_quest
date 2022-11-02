<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $tmpName = $_FILES['license']['tmp_name'];
    $name = $_FILES['license']['name'];
    $uploadDir = 'uploads/';
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Extensions autorisées : .jpg, .jpeg ou .png !';
    }

    if (file_exists($tmpName) && filesize($tmpName) > $maxFileSize) {
        $errors[] = "Votre fichier doit être inférieur à 1Mo !";
    }
    $uniqName = uniqid('', true);
    $fileName = $uniqName . $extension;
    $uploadFile = $uploadDir . $fileName;
    move_uploaded_file($tmpName, $uploadFile);
}

?>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

    <label for="imageUpload">Upload an profile image</label>

    <input type="file" name="license" id="imageUpload" />

    <button name="send">Send</button>

</form>

<section>
    <img src="<?= $uploadFile; ?>" alt="Homer's driver license">
    <p> Name: Homer Simpson <br>
        Age : 66 years old <br>
    </p>

    <button></button>

</section>