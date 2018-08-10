<?php
include("config.php");
$query = "SELECT id,'NC',nom,'NC' AS id_tache from taches UNION ALL SELECT 'NC',id,nom,id_tache from sous_taches ORDER BY id_tache DESC";
$result = $db->query($query) or die($db->error);
$content = '';
$count = 0;

$tab = array();
$a = 0;
while($row = $result->fetch_array()) {

if($row["NC"] == 'NC'){
  // c'est un tache
  $sql3 = "SELECT COUNT(*) as nb FROM sous_taches WHERE id_tache = '".$row["id"]."'";
  $result3 = $db->query($sql3) or die($db->error);
  $row3 = $result3->fetch_array();
  if($row3["nb"] != 0) {
    // C'est un tache complexe (plusueurs sous-taches)
    $tab[$a]["visuel"] = '🏴 '.$row["nom"];
    $tab[$a]["type"] = 'Tâche complexe';
    $tab[$a]["idt"] = $row["id"];
    $tab[$a]["idst"] = '';
    $tab[$a]["nom"] = $row["nom"];
  }else {
    // C'est une tâche simple
    $tab[$a]["visuel"] = $row["nom"];
    $tab[$a]["type"] = 'Tâche simple';
    $tab[$a]["idt"] = $row["id"];
    $tab[$a]["idst"] = '';
    $tab[$a]["nom"] = $row["nom"];
  }
}else {
  // c'est une-sous tache appartenant à une tache complexe
//  $tab[$a]["visuel"] = $row["nom"];
  //$tab[$a]["type"] = 'Sous-Tâche';
  //$tab[$a]["idt"] = '';
  //$tab[$a]["idst"] = $row["NC"];
}
//  $tab[$a]["nom"] = $row["nom"];
  $a++;
}//loop ends here.
echo json_encode($tab, true);

?>
