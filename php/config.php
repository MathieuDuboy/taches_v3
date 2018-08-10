<?php
define("DB_HOST", "localhost"); //Databse Host.
define("DB_USER", "of2ds84i_robert"); //Databse User.
define("DB_PASS", "Pm7xojnz"); //database password.
define("DB_NAME", "of2ds84i_wp587"); //database Name.
/*define("DB_USER", "root"); //Databse User.
define("DB_PASS", "root"); //database password.
define("DB_NAME", "eko_tasks"); //database Name.*/

// inforamtions statiques car obtenues grâce à l'initialisation du CRM EKO
// Obligation de simuler ici
$id_traitant    = '123';
$nom_traitant   = 'Mathieu Gonzalez';
$email_traitant = 'mathieu.duboy@gmail.com';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno > 0) {
    die('Unable to connect to database 1 [' . $db->connect_error . ']');
}
$db->set_charset("utf8");

function time_ago($date)
{
    $timestamp = $date;
    $strTime   = array(
        "secondes",
        "minutes",
        "heures",
        "jours",
        "mois",
        "années"
    );
    $length    = array(
        "60",
        "60",
        "24",
        "30",
        "12",
        "10"
    );

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        if ($diff == 0) {
            return "à l'instant";
        } else {
            return "Il y a " . $diff . " " . $strTime[$i];
        }

    }
}
?>
