<?php
include('config.php');

$sql     = "DELETE FROM `affectation` WHERE `affectation`.`id` = '" . $_GET['id_affectation'] . "' ";
$result  = mysqli_query($db, $sql);

?>
