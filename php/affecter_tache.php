<?php
include("config.php");

$id_projet = $_GET['id_projet'];
$phase = $_GET['phase'];
$recherche_tache = $_GET['recherche_tache'];
$id_tache = $_GET['id_tache'];
$sous_taches = $_GET['sous_taches'];
$date_max = $_GET['date_max'];
$date = explode("/", $date_max);
$date_max_timestamp = strtotime($date[2].'-'.$date[1].'-'.$date[0]);

$traitant = $_GET['traitant'];
$notes = addslashes($_GET['notes']);
$now = time();

$a = 1;
if(isset($_GET['sous_taches'])) {
  foreach($_GET['sous_taches'] as $id_sous_tache) {
    $sql    = "INSERT INTO `affectation` (`id`, `id_projet`, `id_tache`, `id_sous_tache`, `phase`, `date_max`, `date_max_timestamp`, `traitant`,  `ordre`, `ordre_cat`, `statut`, `date_realisation`, `affectation_le`) VALUES ('', '".$id_projet."', '".$id_tache."', '".$id_sous_tache."', '".$phase."', '".$date_max."', '".$date_max_timestamp."', '".$traitant."',  '".$a."','', 'à faire', '', '".$now."');";
    echo $sql;
    $result = mysqli_query($db, $sql);
    $a++;
  }
}else {
  $sql    = "INSERT INTO `affectation` (`id`, `id_projet`, `id_tache`, `id_sous_tache`, `phase`, `date_max`,  `date_max_timestamp`, `traitant`,  `ordre`, `ordre_cat`, `statut`, `date_realisation`, `affectation_le`) VALUES ('', '".$id_projet."', '".$id_tache."', '', '".$phase."', '".$date_max."', '".$date_max_timestamp."', '".$traitant."', '".$a."','', 'à faire', '', '".$now."');";
  $result = mysqli_query($db, $sql);
  echo $sql;
  $id_tache_affectation = mysqli_insert_id($db);
  if($notes != '') {
    $sql_note = "INSERT INTO `notes_taches` (`id`, `id_tache`, `date_ajout`, `note`) VALUES (NULL, '".$id_tache_affectation."', '".$now."', '".$notes."');";
    echo $sql_note;
    $result = mysqli_query($db, $sql_note);
  }
}

$sql_update = "UPDATE `projets` SET `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
echo $sql_update;
$result = mysqli_query($db, $sql_update);
?>
