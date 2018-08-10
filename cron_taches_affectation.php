<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include("php/config.php");
$today_minuit           = date('Y-m-d 00:00:00');
$timestamp_today_minuit = strtotime($today_minuit);
echo $timestamp_today_minuit . '<br />';
$today_late           = date('Y-m-d 23:59:59');
$timestamp_today_late = strtotime($today_late);
echo $timestamp_today_late . '<br />';
$sql    = "SELECT affectation.id,affectation.id_projet,affectation.id_tache,affectation.id_sous_tache,affectation.phase,affectation.date_max,affectation.traitant,affectation.ordre,affectation.statut, taches.nom as nom_tache , sous_taches.nom as nom_sous_tache, users.first_name, users.last_name from affectation
INNER JOIN taches ON affectation.id_tache = taches.id LEFT JOIN sous_taches ON affectation.id_sous_tache = sous_taches.id INNER JOIN users ON affectation.traitant = users.user_id
WHERE affectation.affectation_le BETWEEN $timestamp_today_minuit AND $timestamp_today_late ORDER by affectation.ordre";
$result = mysqli_query($db, $sql);
$tab    = array();
while ($row = mysqli_fetch_array($result, true)) {
    $tab[$row['traitant']][] = $row;
}
$mail             = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'tls';
$mail->Host       = "smtp.gmail.com";
$mail->Port       = 587;
$mail->IsHTML(true);
$mail->Username = "xxxx@gmail.com";
$mail->Password = "xxxxx";
$mail->setFrom('mathieu.duboy@gmail.com', 'Eko Gestion de Tâches');
$mail->addReplyTo('mathieu.duboy@gmail.com', 'Do not Reply');
$mail->Subject = "Affectation de Tâches";
foreach ($tab as $traitant => $taches) {
    $msg = $traitant . ', de nouvelles tâches vous ont été attribuées.<br />';
    foreach ($taches as $key => $tache) {
        $id_projet   = $tache['id_projet'];
        $id_traitant = $tache['traitant'];
        $sql1        = "SELECT * FROM users WHERE user_id = $id_traitant";
        $result1     = mysqli_query($db, $sql1);
        $row1        = mysqli_fetch_array($result1);
        $email       = $row1['email'];
        $sql         = "SELECT * FROM projets WHERE id = $id_projet";
        $result      = mysqli_query($db, $sql);
        $row         = mysqli_fetch_array($result);
        if ($tache['nom_sous_tache'] != '') {
            $msg .= 'Projet : ' . $row['nom'] . ' - ' . $tache['nom_tache'] . ' - ' . $tache['nom_sous_tache'] . '<br />';
        } else {
            $msg .= 'Projet : ' . $row['nom'] . ' - ' . $tache['nom_tache'] . '<br />';
        }
    }
    $mail->Body = $msg;
    $mail->AddAddress($email);
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
}
