<?php
include("config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$nom = addslashes($_GET['nom']);
echo $nom.'<br />';

$id_manager = $_GET['id_manager'];
$manager = $_GET['manager'];
echo $id_manager.'<br />';
$id_client = $_GET['id_client'];
$client = $_GET['client'];
echo $id_client.'<br />';
$id_tech = $_GET['id_tech'];
$tech = $_GET['tech'];
$entreprise = $_GET['entreprise'];
echo $id_tech.'<br />';

$date_debut = $_GET['date_debut'];
echo $date_debut.'<br />';
$date_installation = $_GET['date_installation'];
echo $date_installation.'<br />';
$now = time();

// requete pour ajouter
//
$sql    = "INSERT INTO `projets` (`id`, `nom`, `date_debut`, `date_installation`, `id_manager`, `manager`, `id_client`, `client`, `id_tech`, `tech`, `etat`, `commentaires`, `last_modification`)
VALUES (NULL, '".$nom."', '".$date_debut."', '".$date_installation."', '".$id_manager."', '".$manager."', '".$id_client."','".$entreprise."', '".$id_tech."','".$tech."', 'Initialisé','', '".$now."');";
echo $sql;
$result = mysqli_query($db, $sql);


// envoyer un mail au manager lors de l'ajout
$mail = new PHPMailer(); // create a new object
//$mail->isSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Username = "mathieu.duboy@gmail.com";
$mail->Password = "xxxxxxxxxx";
$mail->setFrom('mathieu.duboy@gmail.com', 'Eko Gestion de Tâches');
$mail->addReplyTo('mathieu.duboy@gmail.com', 'Do not Reply');
$mail->Subject = 'Nouveau projet : '.$nom;
$msg = "Un nouveau projet vient d'être créé : ".$nom."<br />";
$msg .= "Date Début : ".$date_debut."<br />";
$msg .= "Date Installation : ".$date_installation."<br />";
$msg .= "Manager : ".$manager."<br />";
$msg .= "Client : ".$client." / ".$entreprise."<br />";
$msg .= "Contact Technique : ".$tech."<br />";
$msg .= "Etat : Intialisé<br />";
$mail->Body = $msg;
// adresse dynamique
// 1 mail par traitant listant toutes les tâches à terminier pour chaque projet
//$mail->AddAddress($email_traitant);
//$mail->AddAddress($email);
//adresse statitque pour l'exemple :
$mail->AddAddress("mathieu@eko.team");
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}
?>
