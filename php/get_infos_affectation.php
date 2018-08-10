<?php
include('config.php');
$id_affectation = $_GET['id_affectation'];
$sql    = "SELECT * FROM affectation WHERE id = '" . $_GET['id_affectation'] . "' ";
$result = mysqli_query($db, $sql);
while($row = mysqli_fetch_array($result)) {
?>

<form id="form_detail_affectation">
  <input id="detail_phase" name="detail_phase"  type="hidden" value="<?php echo $row["phase"]; ?>">
  <input id="detail_id_projet" name="detail_id_projet"  type="hidden" value="<?php echo $_GET["id_projet"]; ?>">
  <input id="detail_id_affectation" name="detail_id_affectation"  type="hidden" value="<?php echo $id_affectation; ?>">

  <!-- Affichage du reste du formulaire -->
  <div id="detail_step3_affectation">
    <div class="form-group">
      <label for="date_max">Date Max : <?php echo $row["date_max"]; ?></label>
      <input class="form-control" id="detail_date_max" name="detail_date_max" value="<?php echo $row["date_max"]; ?>" type="text">
    </div>
    <div class="form-group">
      <label for="tache">Traitant :</label>
      <?php
       $sql = "SELECT * from users WHERE users.user_type = 'admin'";
       $result=mysqli_query($db,$sql);
       ?>
       <select class="custom-select" id="detail_traitant" name="detail_traitant">
          <?php
           while($row2 = mysqli_fetch_array($result)) {
             if($row2['user_id'] == $row['traitant'])  {
               ?>
               <option value="<?php echo $row2['user_id']; ?>" selected><?php echo $row2['first_name'].' '.$row2['last_name']; ?></option>
               <?php
             }else {
               ?>
               <option value="<?php echo $row2['user_id']; ?>"><?php echo $row2['first_name'].' '.$row2['last_name']; ?></option>
               <?php
             }
           }
           ?>
      </select>
    </div>
    <div class="form-group">
      <label for="notes">Notes : </label>
      <?php
      $sql2a    = "SELECT * FROM notes_taches WHERE id_tache = $id_affectation ORDER BY id DESC";
      $result2a = mysqli_query($db, $sql2a);
      $nb_res = mysqli_num_rows($result2a);
      if($nb_res != 0) {
        echo '<h6>';
        while($row2a = mysqli_fetch_array($result2a))  {
          echo '<i class="fas fa-thumbtack"></i> '.time_ago($row2a['date_ajout']).' par '.$row2a['nom_traitant'].' : '.$row2a['note'].'<br />';
        }
        echo '</h6>';
      }else {
        echo ' Aucune';
      }


      ?>

    </div>
    <div class="form-group">
       <label for="notes">Commentaire :</label>
       <textarea class="form-control" id="detail_notes" name="detail_notes" rows="2"></textarea>
    </div>
  </div>
</form>
<script>
  $( "#detail_date_max" ).datepicker({ dateFormat: 'dd/mm/yy' });
</script>
<?php
}
?>
