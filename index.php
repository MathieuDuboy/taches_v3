<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/style.css" rel="stylesheet">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <link rel="stylesheet" href="css/easy-autocomplete.min.css">

  <title>Gestion de projets EKO</title>
  <style>
  .ui-front {
      z-index: 9999999 !important;
  }
  </style>
</head>
<body>
  <div class="row" style="margin:30px">
    <div class="col" >
        <button type="button" class="btn btn-primary" id="add_projet">Créer projet</button>
        <button type="button" class="btn btn-primary" id="add_tache_button">Ajouter/modifier Tâche</button>
        <button type="button" class="btn btn-primary" id="detail_traitant">Détail pour chaque traitant</button>

    </div>

  </div>
  <div class="row" style="padding:30px">
    <div class="col" >

    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Date Début</th>
          <th scope="col">Date Install</th>
          <th scope="col">Manager</th>
          <th scope="col">Client</th>
          <th scope="col">Tech</th>
          <th scope="col">Etat</th>
          <th scope="col">Détails</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include('php/config.php');
        $query = "SELECT * from projets ORDER BY id";
        $result = $db->query($query) or die($db->error);
        while($row = $result->fetch_array()) {
          extract($row);
          $query2 = "SELECT * from collab
          WHERE collab_id IN ('".$id_manager."', '".$id_client."', '".$id_tech."') ORDER BY FIELD(collab_id, '$id_tech,$id_client,$id_manager');";
          $result2 = $db->query($query2) or die($db->error);
          ?>
          <tr>
            <th scope="row"><?php echo $id; ?></th>
            <td><?php echo $nom; ?></td>
            <td><?php echo $date_debut; ?></td>
            <td><?php echo $date_installation; ?></td>
            <td><?php $tab_manager = explode("/", $manager); echo $tab_manager[0]; ?></td>
            <td><?php echo $client; ?></td>
            <td><?php $tab_tech = explode("/", $tech); echo $tab_tech[0]; ?></td>
            <td><?php echo $etat; ?></td>
            <td><a href="details.php?id_projet=<?php echo $id; ?>"><i class="fas fa-search-plus"></i></a></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  </div>
  <div class="modal" id="modale_projets" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Créer un projet</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="mon_projet" name="mon_projet">
            <div class="form-group">
              <label for="nom">Nom du projet :</label>
              <input class="form-control" autocomplete="off" id="nom" name="nom" placeholder="Exemple : NAS + Installation Office + Wifi" type="text">
            </div>
            <div class="form-group">
              <label for="nom">Managé par :</label>
              <input class="form-control" id="manager" name="manager"  type="text" autocomplete="off" value="">
              <input id="id_manager" name="id_manager"  type="hidden">
            </div>
            <div class="form-row" style="margin-bottom:10px">
              <div class="col-md-6">
                <label for="client">Client :</label>
                <input class="form-control" id="client" name="client"  type="text" autocomplete="off">
                <input id="id_client" name="id_client"  type="hidden">
                <input id="entreprise" name="entreprise"  type="hidden">

              </div>
              <div class="col-md-6">
                <label for="tech">Contact :</label>
                <input class="form-control" id="tech" name="tech"  type="text" autocomplete="off">
                <input id="id_tech" name="id_tech"  type="hidden">
              </div>
            </div>
            <div class="form-row" style="margin-bottom:10px">
              <div class="col-md-6">
                <label for="id_client">Date Début :</label>
                <input class="form-control" id="date_debut" name="date_debut" placeholder="12/12/2018" type="text">
              </div>
              <div class="col-md-6">
                <label for="id_client">Date Installation :</label>
                <input class="form-control" id="date_installation" name="date_installation" placeholder="13/12/2018" type="text">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="button_add_projet" type="submit">Ajouter</button>
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Annuler</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modale_taches" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gestion des tâches</h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="mon_formulaire" name="mon_formulaire">
            <div id="step1">
              <div class="form-group">
                <label for="tache">Ajouter / Modifier</label>
                <?php
                 $sql = "SELECT id,'NC',nom,'NC' AS id_tache from taches UNION ALL SELECT 'NC',id,nom,id_tache from sous_taches ORDER BY id_tache DESC";

                // $sql="SELECT taches.id, taches.nom as nom_tache, sous_taches.nom as nom_sous_tache FROM taches LEFT JOIN sous_taches ON taches.id = sous_taches.id_tache group by nom_tache";
                 $result=mysqli_query($db,$sql);

                 ?> <select class="custom-select" id="tache" name="tache">
                      <option selected value="">Choisissez</option>
                      <option value="add_simple">+ Ajouter une tâche simple</option>
                      <option value="add_multiple">+ Ajouter une tâche multiple</option>
                    <?php
                     while($row = mysqli_fetch_array($result)) {

                       if($row["NC"] == 'NC'){
                         // c'est un tache
                         $sql3 = "SELECT COUNT(*) as nb FROM sous_taches WHERE id_tache = '".$row["id"]."'";
                         $result3 = $db->query($sql3) or die($db->error);
                         $row3 = $result3->fetch_array();
                         if($row3["nb"] != 0) {
                        ?> <option data-type="TacheComplexe" value="<?php echo $row['id']; ?>">🏴 <?php echo $row['nom']; ?></option><?php
                         }else {
                        ?> <option data-type="TacheSimple" value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option><?php
                         }
                       }else {
                         ?> <option data-type="SousTache" value="<?php echo $row['NC']; ?>"><?php echo $row['nom']; ?></option><?php
                       }
                     }
                     ?>
                </select>
              </div>
            </div>
            <div id="step2">
              <div id="div_ajout_simple">
                <div class="form-group">
                  <label for="tache_de_base">Nom de la tâche</label> <input class="form-control" id="sous_tache" name="sous_tache"
                  placeholder="Exemple : Appeler le Client" type="text">
                </div>
              </div>
              <div id="div_ajout_multiple">
                <div class="form-group">
                  <label for="tache_de_base">Nom de la tâche</label> <input class="form-control" id="tache_de_base" name="tache_de_base"
                  placeholder="Exemple : Appeler le Client" type="text">
                </div>
                <div class="input_fields_wrap" id="liste_sous_taches">
                  <label for="add_sous_tache">Liste des sous-tâches</label> <span style="float:right;text-align:right"><button class=
                  "add_field_button btn btn-primary btn-sm" id="add_sous_tache" type="button"><span style="float:right;text-align:right">+
                  Ajouter une tâche</span></button></span>
                </div>
              </div>
              <div id="div_modification">
                <div class="form-group">
                  <label for="tache_de_base_modification">Nom de la tâche</label> <span id="delete_tache_and_sous_taches" style=
                  "color:red;text-align-right;float:right"><i class="fas fa-trash-alt"></i></span> <input class="form-control" id=
                  "tache_de_base_modification" name="tache_de_base_modification" placeholder="Exemple : Appeler le Client" type="text">
                </div>
                <div class="input_fields_wrap_modification" id="liste_sous_taches_modification">
                  <label for="add_sous_tache_modification">Liste des sous-tâches</label> <span style=
                  "float:right;text-align:right"><button class="add_field_button_modification_modification btn btn-primary btn-sm" id=
                  "add_sous_tache_modification" type="button"><span style="float:right;text-align:right">+ Ajouter une
                  tâche</span></button></span>
                </div>
              </div>
            </div><input id="modification" name="modification" type="hidden" value=""> <input id="id_tache" name="id_tache" type="hidden"
            value="">
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" id="refresh" type="button">Recommencer</button> <button class="btn btn-primary" disabled id=
          "valider" type="submit">Valider</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js">
   </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js">
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
  </script>
  <script src="js/jquery.easy-autocomplete.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.24.4/dist/sweetalert2.all.min.js">
  </script>

  <script src="js/script_modale_index.js" type="text/javascript">
  </script>
  <script>
  $("#detail_traitant").click(function() {
    window.location = 'details_traitant.php';
  })
  </script>
</body>
</html>
