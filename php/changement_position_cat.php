<?php
include("config.php");
$id_projet = $_GET['id_projet'];
$etat = $_GET['etat'];
$position = explode(",",$_GET['position']);

$a = 1;
foreach($position as $id_tache) {
  $query2 = "UPDATE `affectation` SET `ordre_cat` = '".$a."' WHERE `affectation`.`id_projet` = '".$id_projet."' AND id_tache = '".$id_tache."' AND phase = '".$etat."' ;";
  echo $query2;
  $result2 = $db->query($query2) or die($db->error);
  $a++;
}


?>
