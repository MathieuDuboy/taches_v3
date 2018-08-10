<?php
include('config.php');

$sql     = "DELETE FROM `fichiers` WHERE `fichiers`.`id` = '" . $_GET['idfichier'] . "' ";
$result  = mysqli_query($db, $sql);
// delete le fichier du serveur
unlink($_GET['chemin']);

?>
