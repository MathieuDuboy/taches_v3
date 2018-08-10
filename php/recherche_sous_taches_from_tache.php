<?php
include("config.php");
$id_tache = $_GET['id_tache'];
$query = "SELECT * FROM sous_taches WHERE id_tache = '".$id_tache."' ";
$result = $db->query($query) or die($db->error);
$nb = mysqli_num_rows($result);
if($nb != 0) {
?>
<div class="form-group">
 <label for="traitant">Selection multiple Sous-Tâches (Cmd ou Ctrl)</label>
	<select multiple class="custom-select" id="sous_taches[]" name="sous_taches[]">
		 <?php
			while($row = mysqli_fetch_array($result)) {
				?>
				 <option selected value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option><?php
			}
			?>
 </select>
</div>
<?php
} ?>
