<?php
include("config.php");
$id_projet = $_GET['id_projet'];
$id_tache = $_GET['id_tache'];

$etat = $_GET['etat'];
$position = explode(",",$_GET['position']);

$a = 1;
foreach($position as $pos) {
  $query2 = "UPDATE `affectation` SET `ordre` = '".$a."' WHERE `affectation`.`id` = '".$pos."' ;";
  echo $query2;
  $result2 = $db->query($query2) or die($db->error);
  $a++;
}


?>
