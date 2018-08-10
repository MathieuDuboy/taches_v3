<?php

$valid_extensions = array(
    'jpeg',
    'jpg',
    'png',
    'gif',
    'bmp',
    'pdf',
    'doc',
    'docx',
    'ppt',
    'pptx',
    'xls',
    'xlsx'
); // valid extensions
$id_projet        = $_POST['id_projet'];
mkdir("uploads/" . $id_projet, 0777);
$path         = 'uploads/' . $_POST['id_projet'] . '/';
$img          = $_FILES['image']['name'];
$tmp          = $_FILES['image']['tmp_name'];
$ext          = strtolower(pathinfo($img, PATHINFO_EXTENSION));
$now          = time();
$final_image  = $img;
$type_fichier = "image";
if ($ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'pptx') {
    $type_fichier = "document";
}
if (in_array($ext, $valid_extensions)) {
    $path = $path . strtolower($final_image);

    if (move_uploaded_file($tmp, $path)) {
        echo "<img src='$path' />";

        include("config.php");
        $sql    = "INSERT INTO `fichiers` (`id`, `chemin`, `type_fichier`, `id_projet`, `nom_traitant`, `date_depot`) VALUES ('', '" . $path . "', '" . $type_fichier . "', '" . $_POST['id_projet'] . "', '" . $_POST['nom_traitant'] . "', '" . $now . "');";
        $result = mysqli_query($db, $sql);

    }
} else {
    echo 'invalid';
}

?>
