<?php
include('config.php');

$sql     = "DELETE FROM `taches` WHERE `taches`.`id` = '" . $_GET['id_tache'] . "' ";
$sql2    = "DELETE FROM `sous_taches` WHERE `sous_taches`.`id_tache` = '" . $_GET['id_tache'] . "' ";
$result  = mysqli_query($db, $sql);
$result2 = mysqli_query($db, $sql2);

?>
