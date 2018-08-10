<?php
include('config.php');
$sous_taches_liste = $_GET['mes_taches'];

if ($_GET['sous_tache'] != '') {
    $sql    = "INSERT INTO taches (id, nom) VALUES (NULL, '" . addslashes(trim($_GET['sous_tache'])) . "')";
    $result = mysqli_query($db, $sql);
} else if ($_GET['tache_de_base'] != '') {
    $sql      = "INSERT INTO taches (id, nom) VALUES (NULL, '" . addslashes(trim($_GET['tache_de_base'])) . "')";
    $result   = mysqli_query($db, $sql);
    $id_tache = mysqli_insert_id($db);
    $a        = 1;
    foreach ($sous_taches_liste as $value) {
        $sql2    = "INSERT INTO `sous_taches` (`id`, `nom`, `id_tache`, `ordre`) VALUES (NULL, '" . addslashes($value) . "', '" . $id_tache . "', '" . $a . "');";
        $result2 = mysqli_query($db, $sql2);
        $a++;
    }
} else if ($_GET['tache_de_base_modification'] != '') {

    $sql      = "UPDATE `taches` SET `nom` = '" . trim($_GET['tache_de_base_modification']) . "' WHERE `taches`.`id` = '" . $_GET['id_tache'] . "' ";
    $result   = mysqli_query($db, $sql);
    $sql2     = "DELETE FROM `sous_taches` WHERE `sous_taches`.`id_tache` = '" . $_GET['id_tache'] . "' ";
    $result2  = mysqli_query($db, $sql2);
    $a        = 1;
    $id_tache = $_GET['id_tache'];
    foreach ($sous_taches_liste as $value) {
        $sql3 = "INSERT INTO `sous_taches` (`id`, `nom`, `id_tache`, `ordre`) VALUES (NULL, '" . addslashes($value) . "', '" . $id_tache . "', '" . $a . "');";
        echo $sql3 . '<br />';
        $result3 = mysqli_query($db, $sql3);
        $a++;
    }
}
?>
