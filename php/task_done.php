<?php
include('config.php');
$id_affectation = $_GET['id_affectation'];

$sql    = "SELECT statut FROM `affectation`  WHERE  `affectation`.`id` = '".$id_affectation."';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);
$statut = $row['statut'];
$now = time();

if($statut == 'à faire') {
  $sql    = "UPDATE `affectation` SET `statut` = 'fait', `date_realisation` = '".$now."'  WHERE `affectation`.`id` = ".$id_affectation.";";
}else {
  $sql    = "UPDATE `affectation` SET `statut` = 'à faire', `date_realisation` = '' WHERE `affectation`.`id` = ".$id_affectation.";";
}

$result = mysqli_query($db, $sql);


?>
