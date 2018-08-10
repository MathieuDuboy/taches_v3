<?php
include('config.php');

$sql    = "SELECT * FROM sous_taches WHERE id_tache = '" . $_GET['id_tache'] . "' ";
$result = mysqli_query($db, $sql);
$a = 1;
while ($row = mysqli_fetch_array($result)) {
?>
 <div class="form-group" id="<?php
    echo $a;
?>"><label>N°<?php
    echo $a;
?> - A déplacer</label><p><input class="form-control" type="text" name="mes_taches[]" placeholder="Exemple : Avertir le Client" value="<?php
    echo $row['nom'];
?>"/><span class="remove_field" style="float:right;text-align:right"><button type="button" class="remove_field btn btn-info btn-sm">- Retirer</button></span></p></div>
  <?php
    $a++;
}
?>
