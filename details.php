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
  <link rel="stylesheet" href="css/easy-autocomplete.min.css">

  <title>Détails du projet <?php echo $_GET["id"]; ?></title>
  <style>

.loader
{
  position:fixed;
  top:0px;
  right:0px;
  width:100%;
  height:100%;
  background-color:#666;
  background-repeat:no-repeat;
  background-position:center;
  z-index:10000000;
  opacity: 0.7;
  filter: alpha(opacity=70); /* For IE8 and earlier */
}
  .selected {
      color: red
    }
  .ui-front {
      z-index: 9999999 !important;
  }
  h5 {
    font-size: 14px
  }
  h6 {
    font-size: 12px
  }
  .enveloppe{
    background:#f1f3fa;
    padding:5px;
    margin:5px
  }
  </style>
</head>
<body>
  <div class="content">
    <div class="loader">
       <div>
         <center>
           <img class="loading-image" src="loading.gif" alt="loading..">
         </center>
       </div>
    </div>
  <?php
  include('php/config.php');
  $id_projet = $_GET["id_projet"];
  $sql    = "SELECT * FROM projets  WHERE id = " . $_GET['id_projet'] . " ";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result);
  ?>
  <div class="row">
    <div class="col-md-6">
      <form id="mon_projet" name="mon_projet">
      <input id="id_projet" name="id_projet"  type="hidden" value="<?php echo $_GET['id_projet']; ?>">
      <input id="traitant" name="traitant"  type="hidden" value="<?php echo $traitant ?>">
      <input id="nom_traitant" name="nom_traitant"  type="hidden" value="<?php echo $nom_traitant; ?>">

      <div class="form-group">
        <label for="nom">Nom du projet #<?php echo $_GET['id_projet']; ?> :</label>
        <input class="form-control" autocomplete="off" id="nom" name="nom" placeholder="Exemple : NAS + Installation Office + Wifi" value="<?php echo $row['nom']; ?>" type="text">
      </div>
      <div class="form-group">
        <label for="nom">Managé par :</label>
        <input class="form-control" id="manager" name="manager"  type="text" autocomplete="off" value="<?php echo $row['manager']; ?>">
        <input id="id_manager" name="id_manager"  type="hidden" value="<?php echo $row['id_manager']; ?>">
      </div>
      <div class="form-row" style="margin-bottom:10px">
        <div class="col-md-6">
          <label for="client">Client :</label>
          <input class="form-control" id="client" name="client"  type="text" autocomplete="off" value="<?php echo $row['client']; ?>">
          <input id="id_client" name="id_client"  type="hidden" value="<?php echo $row['id_client']; ?>">
        </div>
        <div class="col-md-6">
          <label for="tech">Contact :</label>
          <input class="form-control" id="tech" name="tech"  type="text" autocomplete="off" value="<?php echo $row['tech']; ?>">
          <input id="id_tech" name="id_tech"  type="hidden" value="<?php echo $row['id_tech']; ?>">
        </div>
      </div>
      <div class="form-row" style="margin-bottom:10px">
        <div class="col">
        <label for="id_client">Etat du projet :</label>
        <select name="etat" id="etat" class="custom-select">
          <option value="<?php echo $row['etat']; ?>" selected><?php echo $row['etat']; ?></option>
          <option value="Initialisé">Initialisé</option>
          <option value="En cours de constitution">En cours de constitution</option>
          <option value="Suspendu Client">Suspendu Client</option>
          <option value="Suspendu EKO">Suspendu EKO</option>
          <option value="Prêt pour déploiement">Prêt pour déploiement</option>
          <option value="Déploiement en cours">Déploiement en cours</option>
          <option value="Déployé – Recette à venir">Déployé – Recette à venir</option>
          <option value="Déployé - Recetté">Déployé - Recetté</option>
          <option value="Annulé">Annulé</option>
        </select></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-row" style="margin-bottom:10px">
        <div class="col-md-6">
          <label for="id_client">Date Début :</label>
          <input class="form-control" id="date_debut" name="date_debut" placeholder="12/12/2018" type="text" value="<?php echo $row['date_debut']; ?>" autocomplete="off">
        </div>
        <div class="col-md-6">
          <label for="id_client">Date Installation :</label>
          <input class="form-control" id="date_installation" name="date_installation" placeholder="13/12/2018" type="text" value="<?php echo $row['date_installation']; ?>" autocomplete="off">
        </div>
      </div>

    <div class="form-row">
      <div class="col-md-6">
        <label for="textarea">Commentaires : </label>
        <textarea class="form-control" rows="4" id="commentaires" name="commentaires"><?php echo $row['commentaires']; ?></textarea>
      </div>
      <div class="col-md-6" id="zone_upload">
        <label for="id_client">Fichiers liés : </label>
        <input id="uploadImage" type="file"  name="image" />
        <div id="preview" style="background-color:white">
          <?php
          $sql2    = "SELECT * FROM fichiers  WHERE id_projet = '" .$_GET['id_projet'] . "' ";
          $result2 = mysqli_query($db, $sql2);
          while($row2 = mysqli_fetch_array($result2)) {
            if($row2['type_fichier'] == 'image') {
              ?>
              <h6><i class="fas fa-images"></i> <?php echo time_ago($row2['date_depot']); ?> par  <?php echo $row2['nom_traitant']; ?> : <a href="php/<?php echo $row2['chemin']; ?>"><?php echo $row2['chemin']; ?></a><span style="float:right"><i data-idfichier="<?php echo $row2['id']; ?>" data-chemin="<?php echo $row2['chemin']; ?>" class="remove_doc fas fa-trash-alt"></i></span></h6>
              <?php
            }
            else {
              ?>
              <h6><i class="fas fa-file-alt"></i> <?php echo time_ago($row2['date_depot']); ?> par  <?php echo $row2['nom_traitant']; ?> : <a href="php/<?php echo $row2['chemin']; ?>"><?php echo $row2['chemin']; ?></a><span style="float:right"><i data-idfichier="<?php echo $row2['id']; ?>" data-chemin="<?php echo $row2['chemin']; ?>" class="remove_doc fas fa-trash-alt"></i></span></h6>
              <?php
            }
          }
          ?>
        </div><br/>
        <input class="btn btn-success" id="valider_upload" type="button" value="Télécharger">
      </div>
    </div>

    <div class="form-row" style="margin:10px 0px">
      <div class="col" style="margin:10px 0px">
        <label for="id_client">Dernière modification : <?php echo time_ago($row["last_modification"]); ?> </label>
      </div>
    </div>
    <div class="form-row" style="margin-bottom:10px">
    <div class="col" style="text-align:right;float:right">
        <button type="button" class="btn btn-info" id="liste_projets"><i class="fas fa-chevron-circle-left"></i> Liste des projets</button>
        <button type="button" class="btn btn-primary" id="add_tache_button"><i class="fas fa-plus-square"></i> Ajouter/Modifier des Tâches</button>
    </div>
  </div>
  </div>
  </form>
  </div>
  <hr />
    <div class="row">
			<div class="col-md-4 margin-bottom-30">
				<!-- BEGIN Portlet PORTLET-->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">
							<i class="glyphicon glyphicon-calendar"></i>
							<span class="caption-subject text-uppercase">PRE-PROD</span>
							<span class="caption-helper"></span>
						</div>
            <div class="actions">
              <span data-type="PRE-PROD" class="btn add_task">
                <i class="fas fa-plus-circle"></i>
                Ajouter
              </span>
            </div>
					</div>
          <div class="portlet-body">
            <?php
             $sql = "SELECT affectation.id,affectation.id_projet,affectation.id_tache,affectation.date_realisation,affectation.ordre_cat,affectation.id_sous_tache,affectation.phase,affectation.date_max,affectation.traitant,affectation.ordre,affectation.statut, taches.nom as nom_tache , sous_taches.nom as nom_sous_tache, users.first_name, users.last_name from affectation INNER JOIN taches ON affectation.id_tache = taches.id LEFT JOIN sous_taches ON affectation.id_sous_tache = sous_taches.id INNER JOIN users ON affectation.traitant = users.user_id WHERE affectation.phase = 'PRE-PROD' AND id_projet = '".$id_projet."' ORDER by affectation.ordre_cat, affectation.ordre";
             $result=mysqli_query($db,$sql);

             $tab = [];
             while($row = mysqli_fetch_array($result, true))  {
               $tab[$row['nom_tache']][] = $row;
               // ajouter au tableau par
             }

                  $u = 1;
                 foreach($tab as $key => $grosse_tache){
                   ?>
                  <div class="un_groupe" data-etat="PRE-PROD" id="<?php echo $grosse_tache[0]['id_tache']; ?>"><h5><i class="fas fa-thumbtack"></i> <?php echo $key; ?></h5>
                   <div class="enveloppe">
                     <?php
                     foreach($grosse_tache as $petite_tache){
                       $id = $petite_tache['id'];
                       $sql2a    = "SELECT * FROM notes_taches WHERE id_tache =  $id ";
                       $result2a = mysqli_query($db, $sql2a);
                       $nb_res = mysqli_num_rows($result2a);


                       ?>
                     <div data-etat="<?php echo $petite_tache["phase"]; ?>" data-idtache="<?php echo $petite_tache["id_tache"]; ?>" id="<?php echo $petite_tache["id"]; ?>" data-idaffectation="<?php echo $petite_tache["id"]; ?>" class="petite_tache card  <?php if($petite_tache["statut"] == 'fait') echo 'bg-primary text-white';  else echo 'bg-light text-black'?>  mb-3" >
                       <div class="card-body" style="padding:0.8em">
                         <h6 class="card-title"><input type="checkbox" <?php if($petite_tache["statut"] == 'fait') echo 'checked'; ?> class="checkbox_done" data-id="<?php echo $petite_tache["id"]; ?>"> <?php
                         if($petite_tache["nom_sous_tache"] != '')
                         echo $petite_tache["nom_sous_tache"];
                         else
                         echo $petite_tache["nom_tache"];
                         ?></h6>
                         <h6 class="card-subtitle"><?php echo $petite_tache["first_name"]; ?>  <?php if($petite_tache["date_realisation"] != '') {
                            ?><span style="float:right"><i class="fas fa-check" style="color:#008000"></i> <?php echo time_ago($petite_tache["date_realisation"]); ?></span><?php
                          }else {
                            ?><span style="float:right"><?php echo $petite_tache["date_max"]; ?> <?php if($nb_res != 0) echo '/ <i class="fas fa-comment-alt"></i>'; ?></span><?php
                          }
                          ?></h6>
                       </div>
                     </div>
                     <?php
                      }
                      ?>
                   </div>
                  </div>
                   <?php
                   $u++;
                 }
              ?>
          </div>
				</div>
				<!-- END Portlet PORTLET-->
			</div>
      <div class="col-md-4 margin-bottom-30">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet">
          <div class="portlet-title">
            <div class="caption">
              <i class="glyphicon glyphicon-calendar"></i>
              <span class="caption-subject text-uppercase">PROD</span>
              <span class="caption-helper"></span>
            </div>
            <div class="actions">
              <span data-type="PROD" class="btn add_task">
                <i class="fas fa-plus-circle"></i>
                Ajouter
              </span>
            </div>
          </div>
          <div class="portlet-body">
            <?php
             $sql = "SELECT affectation.id,affectation.id_projet,affectation.date_realisation,affectation.id_tache,affectation.ordre_cat,affectation.id_sous_tache,affectation.phase,affectation.date_max,affectation.traitant,affectation.ordre,affectation.statut, taches.nom as nom_tache , sous_taches.nom as nom_sous_tache, users.first_name, users.last_name from affectation INNER JOIN taches ON affectation.id_tache = taches.id LEFT JOIN sous_taches ON affectation.id_sous_tache = sous_taches.id INNER JOIN users ON affectation.traitant = users.user_id WHERE affectation.phase = 'PROD' AND id_projet = '".$id_projet."' ORDER by affectation.ordre_cat,affectation.ordre";
             $result=mysqli_query($db,$sql);

             $tab = [];
             while($row = mysqli_fetch_array($result, true))  {
               $tab[$row['nom_tache']][] = $row;
               // ajouter au tableau par
             }
             $u = 1;
                 foreach($tab as $key => $grosse_tache){
                   ?>
                <div class="un_groupe"  data-etat="PROD" id="<?php echo $grosse_tache[0]['id_tache']; ?>">  <h5><i class="fas fa-thumbtack"></i> <?php echo $key; ?></h5>
                   <div class="enveloppe">
                     <?php
                     foreach($grosse_tache as $petite_tache){
                       $id = $petite_tache['id'];
                       $sql2a    = "SELECT * FROM notes_taches WHERE id_tache =  $id ";
                       $result2a = mysqli_query($db, $sql2a);
                       $nb_res = mysqli_num_rows($result2a);
                       ?>

                     <div data-etat="<?php echo $petite_tache["phase"]; ?>" data-idtache="<?php echo $petite_tache["id_tache"]; ?>" id="<?php echo $petite_tache["id"]; ?>" data-idaffectation="<?php echo $petite_tache["id"]; ?>" class="petite_tache card  <?php if($petite_tache["statut"] == 'fait') echo 'bg-primary text-white';  else echo 'bg-light text-black'?>  mb-3" >
                       <div class="card-body" style="padding:0.8em">
                         <h6 class="card-title"><input type="checkbox" <?php if($petite_tache["statut"] == 'fait') echo 'checked'; ?> class="checkbox_done" data-id="<?php echo $petite_tache["id"]; ?>"> <?php
                         if($petite_tache["nom_sous_tache"] != '')
                         echo $petite_tache["nom_sous_tache"];
                         else
                         echo $petite_tache["nom_tache"];
                         ?></h6>
                         <h6 class="card-subtitle"><?php echo $petite_tache["first_name"]; ?>  <?php if($petite_tache["date_realisation"] != '') {
                           ?><span style="float:right"><i class="fas fa-check" style="color:#008000"></i> <?php echo time_ago($petite_tache["date_realisation"]); ?></span><?php
                          }else {
                            ?><span style="float:right"><?php echo $petite_tache["date_max"]; ?> <?php if($nb_res != 0) echo '/ <i class="fas fa-comment-alt"></i>'; ?></span><?php
                          }
                          ?></h6>
                       </div>
                     </div></div>
                     <?php
                      }
                      ?>
                   </div>
                   <?php
                   $u++;
                 }
              ?>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
      <div class="col-md-4 margin-bottom-30">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet">
          <div class="portlet-title">
            <div class="caption">
              <i class="glyphicon glyphicon-calendar"></i>
              <span class="caption-subject text-uppercase">POST-PROD</span>
              <span class="caption-helper"></span>
            </div>
            <div class="actions">
              <span data-type="POST-PROD" class="btn add_task">
                <i class="fas fa-plus-circle"></i>
                Ajouter
              </span>
            </div>
          </div>
          <div class="portlet-body">
            <?php
             $sql = "SELECT affectation.id,affectation.id_projet,affectation.date_realisation,affectation.id_tache,affectation.ordre_cat,affectation.id_sous_tache,affectation.phase,affectation.date_max,affectation.traitant,affectation.ordre,affectation.statut, taches.nom as nom_tache , sous_taches.nom as nom_sous_tache, users.first_name, users.last_name from affectation INNER JOIN taches ON affectation.id_tache = taches.id LEFT JOIN sous_taches ON affectation.id_sous_tache = sous_taches.id INNER JOIN users ON affectation.traitant = users.user_id WHERE affectation.phase = 'POST-PROD' AND id_projet = '".$id_projet."' ORDER by affectation.ordre_cat,affectation.ordre";
             $result=mysqli_query($db,$sql);

             $tab = [];
             while($row = mysqli_fetch_array($result, true))  {
               $tab[$row['nom_tache']][] = $row;
               // ajouter au tableau par
             }
             $u = 1;
                 foreach($tab as $key => $grosse_tache){
                   ?>
                   <div class="un_groupe" data-etat="POST-PROD" id="<?php echo $grosse_tache[0]['id_tache']; ?>"><h5><i class="fas fa-thumbtack"></i> <?php echo $key; ?></h5>
                   <div class="enveloppe" >
                     <?php
                     foreach($grosse_tache as $petite_tache){
                       $id = $petite_tache['id'];
                       $sql2a    = "SELECT * FROM notes_taches WHERE id_tache =  $id ";
                       $result2a = mysqli_query($db, $sql2a);
                       $nb_res = mysqli_num_rows($result2a);
                       ?>
                     <div data-etat="<?php echo $petite_tache["phase"]; ?>" data-idtache="<?php echo $petite_tache["id_tache"]; ?>" id="<?php echo $petite_tache["id"]; ?>" data-idaffectation="<?php echo $petite_tache["id"]; ?>" class="petite_tache card  <?php if($petite_tache["statut"] == 'fait') echo 'bg-primary text-white';  else echo 'bg-light text-black'?>  mb-3" >
                       <div class="card-body" style="padding:0.8em">
                         <h6 class="card-title"><input type="checkbox" <?php if($petite_tache["statut"] == 'fait') echo 'checked'; ?> class="checkbox_done" data-id="<?php echo $petite_tache["id"]; ?>"> <?php
                         if($petite_tache["nom_sous_tache"] != '')
                         echo $petite_tache["nom_sous_tache"];
                         else
                         echo $petite_tache["nom_tache"];
                         ?></h6>
                         <h6 class="card-subtitle"><?php echo $petite_tache["first_name"]; ?>
                           <?php if($petite_tache["date_realisation"] != '') {
                             ?><span style="float:right"><i class="fas fa-check" style="color:#008000"></i> <?php echo time_ago($petite_tache["date_realisation"]); ?></span><?php
                           }else {
                             ?><span style="float:right"><?php echo $petite_tache["date_max"]; ?> <?php if($nb_res != 0) echo '/ <i class="fas fa-comment-alt"></i>'; ?></span><?php
                           }
                           ?>
                         </h6>
                       </div>
                     </div>
                     <?php
                      }
                      ?>
                   </div></div>
                   <?php
                   $u++;
                 }
              ?>
          </div>
        </div>
        <!-- END Portlet PORTLET-->
      </div>
		</div>
  </div>
  <div class="modal" id="detail_affectation" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modifier une affectation </h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div id="body_detail_affectation" class="modal-body">

        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" id="detail_delete_affectation" type="button">Supprimer</button> <button class="btn btn-primary"  id=
          "detail_valider_affectation" type="submit">Valider</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modale_affectation" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Affecter une Tâche <span id="type_tache_affectation"></span></h5><button aria-label="Close" class="close" data-dismiss="modal" type=
          "button"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="form_affectation">
            <input id="phase" name="phase"  type="hidden" value="">
            <input id="id_projet" name="id_projet"  type="hidden" value="<?php echo $_GET["id_projet"]; ?>">
            <input id="type_de_tache_selected" name="type_de_tache_selected"  type="hidden" value="">

            <div id="step1_affectation">
              <div class="form-group">
                <label for="recherche_tache">Tâche :</label>
                <input class="form-control" id="recherche_tache" name="recherche_tache"  type="text" autocomplete="off" value="">
                <input id="id_tache" name="id_tache"  type="hidden" value="">
                <input id="id_stache" name="id_stache"  type="hidden" value="">

              </div>

            </div>
            <!-- Affichage des sous-tâches si c'est une tache complexe // remplissage a partir de ajax -->
            <div id="step2_affectation">

            </div>
            <!-- Affichage du reste du formulaire -->
            <div id="step3_affectation">
              <div class="form-group">
                <label for="date_max">Date Max :</label>
                <input autocomplete="off" class="form-control" id="date_max" name="date_max" type="text">
              </div>
              <div class="form-group">
                <label for="tache">Traitant :</label>
                <?php
                 $sql = "SELECT * from users WHERE users.user_type = 'admin'";
                 $result=mysqli_query($db,$sql);
                 ?>
                 <select class="custom-select" id="traitant" name="traitant">
                    <?php
                     while($row = mysqli_fetch_array($result)) {
                       ?>
                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name'].' '.$row['last_name']; ?></option><?php
                     }
                     ?>
                </select>
              </div>
              <div id="step4_affectation" class="form-group">
                 <label for="notes">Commentaire :</label>
                 <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" id="refresh_affectation" type="button">Recommencer</button> <button class="btn btn-primary" disabled id=
          "valider_affectation" type="submit">Valider</button> <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALE AJOUT DES TACHES -->
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
  <!-- FIN MODALE AJOUT DES TACHES -->


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

  <script src="js/script_details.js" type="text/javascript">
  </script>
  <script>
  $(function() {
    $(".remove_doc").click(function() {
      var idfichier = $(this).data("idfichier");
      var chemin = $(this).data("chemin");

      swal({
        title: 'Etes-vous certain ?',
        text: "Cette action est irréversible !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, Supprimer !',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.value) {
          // ajax delete
          $.ajax({
            url: 'php/delete_fichier.php?idfichier='+idfichier+'&chemin='+chemin,
            success: function(data) {
              console.log(data);
              window.location.reload();
            }
        });
        }
      })
    })
    $('.loader').hide();
    $("#valider_upload").on('click',(function(e) {
      var form_data = new FormData($("#mon_projet")[0]);
      e.preventDefault();
      $.ajax({
      url: "php/upload.php",
       type: "POST",
       data:  form_data,
       contentType: false,
       cache: false,
       processData:false,
       beforeSend: function(){
            $('.loader').show()
        },
       complete: function(){
            $('.loader').hide();
       },
       success: function(data)
          {
        if(data=='invalid')
        {
        swal("Format invalide !");
      }else {
        $("#uploadImage").val('');
        window.location.reload();
      }
        },
       error: function(e)
        {
          //$("#err").html(e).fadeIn();
          swal("un erreur s'est produite !");
        }
      });
     }));

  $( ".enveloppe" ).sortable( {
      axis: 'y',
      update: function (event, ui) {
            var id_projet = $("#id_projet").val();
            console.log(id_projet);
            var etat = ui.item.data("etat");
            var id_tache = ui.item.data("idtache");
            console.log(etat);
            var data = $(this).sortable('toArray');
            var id = $(this).parent().attr("id");
            // POST to server using $.post or $.ajax
              $.ajax({
                data: data,
                type: 'POST',
                url: 'php/changement_position_interne.php?id_projet='+id_projet+'&etat='+etat+'&position='+data+'&id_tache='+id_tache,
                success: function(data) {
                  console.log(data);
                  window.location.reload();
                }
            });
        }
        });
  $(".portlet-body").sortable(
    {
        axis: 'y',
        update: function (event, ui) {
              var id_projet = $("#id_projet").val();
              console.log(id_projet);
              var etat = ui.item.data("etat");
              console.log(etat)
              var data = $(this).sortable('toArray');
              console.log("data =: "+data);

              // POST to server using $.post or $.ajax
                $.ajax({
                  data: data,
                  type: 'POST',
                  url: 'php/changement_position_cat.php?id_projet='+id_projet+'&etat='+etat+'&position='+data,
                  success: function(data) {
                    console.log(data);
                  //  window.location.reload();
                  }
              });
          }
    }
  );
  $(".petite_tache").css("cursor", "pointer");
  $(".petite_tache").click(function() {
    var id_affectation = $(this).data("idaffectation");
    var id_projet = $("#id_projet").val();
    $('#detail_id_affectation').val(id_affectation);
    $( "#body_detail_affectation" ).load( "php/get_infos_affectation.php?id_affectation="+id_affectation+'&id_projet='+id_projet, function() {
      $("#detail_affectation").modal("show");
    });

    // remplir le body contenu de la modale avec du php provenant d'ailleurs
  });
  $('#detail_delete_affectation').click(function() {
    var id_affectation = $('#detail_id_affectation').val();
    swal({
      title: 'Etes-vous certain ?',
      text: "Cette action est irréversible",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, supprimer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        console.log("delete ok");
        $.ajax({
          url: "php/delete_affectation.php", //this is the submit URL
          type: 'GET', //or POST
          data: {
            id_affectation: id_affectation
          },
          success: function(data) {
            console.log(data);
            $("#detail_affectation").modal("hide");
            window.location.reload();
          }
        });
      }
    })
  });
  $("#detail_valider_affectation").click(function()  {
    // serialize : form_detail_affectation
    event.preventDefault();
    var serial = $("#form_detail_affectation").serialize();
    console.log(serial);
    // faire les verifs sur les inputs ...
    var type_de_modif = $("#modification").val();
    var traitant = $("#traitant").val();
    var nom_traitant = $("#nom_traitant").val();

    $.ajax({
      url: "php/modifier_affectation.php?traitant="+traitant+"&nom_traitant="+nom_traitant, //this is the submit URL
      type: 'GET', //or POST
      data: $("#form_detail_affectation").serialize(),
      success: function(data) {
        console.log(data);
        $("#detail_affectation").modal("hide");
        window.location.reload();
      }
    });
  });

  $(".add_task").click(function() {
    var type = $(this).data("type");
    console.log(type);
    $("#phase").val(type);
    $("#modale_affectation").modal("show");
    $('#step2_affectation').hide();
    $('#step3_affectation').hide();
    $('#step4_affectation').hide();
    $("#type_tache_affectation").html(type);
  });
  $('#refresh_affectation').click(function() {
    window.location.reload();
  });

  $(".checkbox_done").change(function(e) {
    e.stopPropagation();
    var id_affectation =  $(this).data("id");
    if(this.checked) {
      // passer status de
      $.ajax({
        url: "php/task_done.php?id_affectation="+id_affectation, //this is the submit URL
        type: 'GET', //or POST
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    }else {
      $.ajax({
        url: "php/task_done.php?id_affectation="+id_affectation, //this is the submit URL
        type: 'GET', //or POST
        success: function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    }
  });

  $( "#date_max" ).datepicker({ dateFormat: 'dd/mm/yy' });



  $("#valider_affectation").click(function() {
    console.log("ok")
    event.preventDefault();
    var serial = $("#form_affectation").serialize();
    var type_de_tache_selected = $("#type_de_tache_selected").val();
    console.log(serial);
    $.ajax({
      url: "php/affecter_tache.php", //this is the submit URL
      type: 'GET', //or POST
      data: $("#form_affectation").serialize(),
      success: function(data) {
        console.log(data);
        $("#modale_affectation").modal("hide");
        window.location.reload();
      },
      error : function(err) {
        console.log(err);
        //window.location.reload();
      }
    });
  })
  });
</script>
</body>
</html>
