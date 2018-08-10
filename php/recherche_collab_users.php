<?php
include("config.php");
$type_de_recherche = $_GET['type'];
$recherche = $_GET['recherche'];
$entreprise = $_GET['entreprise'];
//echo $client;

global $db;
global $label_obj;
if($type_de_recherche == 'manager') {
	$query = "SELECT * from users WHERE user_type = 'admin'";
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();
$a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $val = $first_name.' '.$last_name.' / '.$company.' : '.$email.' ##Id::'.$user_id.' - ##cid:';
    $tab[$a]["visuel"] = $first_name.' '.$last_name.' / '.$company.' : '.$email;
    $tab[$a]["nom_prenom"] = $first_name.' '.$last_name;
    $tab[$a]["id"] = $user_id;
    $tab[$a]["cid"] = '';
    $tab[$a]["email"] = $email;
    $tab[$a]["company"] = $company;
    $a++;

  }//loop ends here.
}else if($type_de_recherche == 'client') {
	$query = "SELECT * from users WHERE user_type = 'client'";
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();
  $a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $val = $first_name.' '.$last_name.' / '.$company.' : '.$email.' ##Id::'.$user_id.' - ##cid:';
    $tab[$a]["visuel"] = $first_name.' '.$last_name.' / '.$company.' : '.$email;
    $tab[$a]["nom_prenom"] = $first_name.' '.$last_name;
    $tab[$a]["id"] = $user_id;
    $tab[$a]["cid"] = '';
    $tab[$a]["email"] = $email;
    $tab[$a]["company"] = $company;
    $a++;
  }//loop ends here.
}
else if($type_de_recherche == 'tech') {
  // Si existance de entreprise on filtre par collab de la meme $entreprise sinon, rien à faire !
  if($entreprise != '') {
    $query = "SELECT * from collab INNER JOIN users ON collab.collab_clientid = users.user_id WHERE collab.collab_t = 1 AND users.company = '".$entreprise."' ";
  }else {
    $query = "SELECT * from collab INNER JOIN users ON collab.collab_clientid = users.user_id WHERE collab.collab_t = 1";
  }
  $result = $db->query($query) or die($db->error);
  $content = '';
  $count = 0;

  $tab = array();

$a = 0;
  while($row = $result->fetch_array()) {
    extract($row);
    $val = $collab_pname.' '.$collab_name.' / '.$company.' : '.$collab_mail.' ##Id::'.$collab_id.' - ##cid:'.$collab_clientid;
    $tab[$a]["visuel"] = $collab_pname.' '.$collab_name.' / '.$company.' : '.$collab_mail;
    $tab[$a]["nom_prenom"] = $collab_pname.' '.$collab_name;
    $tab[$a]["id"] = $collab_id;
    $tab[$a]["cid"] = $collab_clientid;
    $tab[$a]["email"] = $collab_mail;
    $tab[$a]["company"] = $company;
    $a++;
  }//loop ends here.
}

echo json_encode($tab);

?>
