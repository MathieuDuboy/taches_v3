<?php
include('config.php');

$id_projet = $_GET['detail_id_projet'];
$traitant = $_GET['traitant'];
$nom_traitant = $_GET['nom_traitant'];
$detail_id_affectation = $_GET['detail_id_affectation'];
$detail_date_max = $_GET['detail_date_max'];
$detail_traitant = $_GET['detail_traitant'];
$detail_notes = addslashes($_GET['detail_notes']);

$now = time();
$date = explode("/", $detail_date_max);
$detail_date_max_timestamp = strtotime($date[2].'-'.$date[1].'-'.$date[0]);





if($detail_notes == '') {
  // select dans la bdd et comparaison
  // Ajout de la note en fonction
  $sql = "SELECT * from affectation WHERE id = '".$detail_id_affectation."' ";
  echo $sql;
  $res = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($res);
  $actual_date_max = $row["date_max"];
  $actual_traitant = $row["traitant"];
  echo  $row["date_max"].' '.$detail_date_max;
  echo  $row["traitant"].' '.$detail_traitant;

    if($actual_traitant != $detail_traitant && $actual_date_max != $detail_date_max) {
      $note = 'Changement Date_Max & Traitant';
    }else if($actual_traitant != $detail_traitant){
      $note = 'Changement Traitant';
    }else if($actual_date_max != $detail_date_max) {
      $note = 'Changement Date_Max';
    }
    $sql_note = "INSERT INTO `notes_taches` (`id`,`traitant`, `nom_traitant`, `id_tache`, `date_ajout`, `note`) VALUES (NULL, '".$traitant."','".$nom_traitant."','".$detail_id_affectation."', '".$now."', '".$note."');";
    echo $sql_note;
    $result = mysqli_query($db, $sql_note);
    $sql_update = "UPDATE `projets` SET `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
    $result = mysqli_query($db, $sql_update);
    // trait
    $sql = "UPDATE `affectation` SET `date_max` = '".$detail_date_max."', `date_max_timestamp` = '".$detail_date_max_timestamp."', `traitant` = '".$detail_traitant."' WHERE `affectation`.`id` = '".$detail_id_affectation."' ;";
    $result = mysqli_query($db, $sql);
    // add note
}else {
  $sql_note = "INSERT INTO `notes_taches` (`id`,`traitant`, `nom_traitant`, `id_tache`, `date_ajout`, `note`) VALUES (NULL, '".$traitant."','".$nom_traitant."','".$detail_id_affectation."', '".$now."', '".$detail_notes."');";
  $result = mysqli_query($db, $sql_note);
  echo $sql_note;
  $sql_update = "UPDATE `projets` SET `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
  $result = mysqli_query($db, $sql_update);
  # code...
  // trait
  $sql = "UPDATE `affectation` SET `date_max` = '".$detail_date_max."', `date_max_timestamp` = '".$detail_date_max_timestamp."', `traitant` = '".$detail_traitant."' WHERE `affectation`.`id` = '".$detail_id_affectation."' ;";
  $result = mysqli_query($db, $sql);
  // add note
}

?>
