<?php
include('config.php');

$id_projet = $_GET['id_projet'];
$now = time();
if(isset($_GET['id_manager'])) {
  $sql = "UPDATE `projets` SET `manager` = '".addslashes($_GET['manager'])."', `id_manager` = '".$_GET['id_manager']."',`last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['id_client']))  {
  $sql = "UPDATE `projets` SET `client` = '".addslashes($_GET['client'])."', `id_client` = '".$_GET['id_client']."',`last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['id_tech']))  {
  $sql = "UPDATE `projets` SET `tech` = '".addslashes($_GET['tech'])."', `id_tech` = '".$_GET['id_tech']."',`last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['nom']))  {
  $sql = "UPDATE `projets` SET `nom` = '".addslashes($_GET['nom'])."', `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['date_debut']))  {
  $sql = "UPDATE `projets` SET `date_debut` = '".$_GET['date_debut']."', `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['date_installation']))  {
  $sql = "UPDATE `projets` SET `date_installation` = '".$_GET['date_installation']."', `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['etat']))  {
  $sql = "UPDATE `projets` SET `etat` = '".$_GET['etat']."', `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}else if(isset($_GET['commentaires']))  {
  $sql = "UPDATE `projets` SET `commentaires` = '".addslashes($_GET['commentaires'])."', `last_modification` = '".$now."' WHERE `projets`.`id` = $id_projet;";
}
$result = mysqli_query($db, $sql);

?>
