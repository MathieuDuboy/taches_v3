$(function() {
  //modale_projets
  $("#add_projet").click(function() {
    $("#modale_projets").modal("show");
  })
  // add le projet
  $("#button_add_projet").click(function() {
    // serialize mon_projet
    event.preventDefault();
    var serial = $("#mon_projet").serialize();
    console.log(serial);
    $.ajax({
      url: "php/ajouter_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: $("#mon_projet").serialize(),
      success: function(data) {
        console.log(data);
        $("#modale_projets").modal("hide");
        window.location.reload();
      }
    });
  })
  $("#date_debut").datepicker({
    dateFormat: 'dd/mm/yy'
  });
  $("#date_installation").datepicker({
    dateFormat: 'dd/mm/yy'
  });
  // Modifications au Blur de tous les champs
  var options_manager = {
    url: function(phrase) {
      return "php/recherche_collab_users.php?type=manager";
    },
    getValue: function(element) {
      console.log(element);
      return element.visuel;
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
    preparePostData: function(data) {
      data.phrase = $("#manager").val();
      return data;
    },
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
        var visuel = $("#manager").getSelectedItemData().visuel;
        var nom_prenom = $("#manager").getSelectedItemData().nom_prenom;
        var id_manager = $("#manager").getSelectedItemData().id;
        var email = $("#manager").getSelectedItemData().email;
        var company = $("#manager").getSelectedItemData().company;
        var id_projet = $('#id_projet').val();
        $('#manager').val(nom_prenom);
        $('#id_manager').val(id_manager);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  var options_client = {
    url: function(phrase) {
      return "php/recherche_collab_users.php?type=client";
    },
    getValue: function(element) {
      console.log(element);
      return element.visuel;
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
    preparePostData: function(data) {
      data.phrase = $("#client").val();
      return data;
    },
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
        var visuel = $("#client").getSelectedItemData().visuel;
        var nom_prenom = $("#client").getSelectedItemData().nom_prenom;
        var id_client = $("#client").getSelectedItemData().id;
        var email = $("#client").getSelectedItemData().email;
        var company = $("#client").getSelectedItemData().company;
        var id_projet = $('#id_projet').val();
        $('#client').val(company);
        $('#id_client').val(id_client);
        $('#entreprise').val(company);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  var options_tech = {
    url: function(phrase) {
      return "php/recherche_collab_users.php?type=tech";
    },
    getValue: function(element) {
      console.log(element);
      return element.visuel;
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
    preparePostData: function(data) {
      data.phrase = $("#tech").val();
      return data;
    },
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
        var visuel = $("#tech").getSelectedItemData().visuel;
        var nom_prenom = $("#tech").getSelectedItemData().nom_prenom;
        var id_client = $("#tech").getSelectedItemData().id;
        var email = $("#tech").getSelectedItemData().email;
        var company = $("#tech").getSelectedItemData().company;
        var id_projet = $('#id_projet').val();
        $('#tech').val(nom_prenom);
        $('#id_tech').val(id_client);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  $("#manager").easyAutocomplete(options_manager);
  $("#client").easyAutocomplete(options_client);
  $("#tech").easyAutocomplete(options_tech);
  //modale_taches
  $("#add_tache_button").click(function() {
    $("#modale_taches").modal("show");
  });
  var max_fields = 10;
  var wrapper = $(".input_fields_wrap");
  var add_button = $(".add_field_button");
  var x = 1;
  $("#liste_sous_taches").hide();
  $("#div_ajout_simple").hide();
  $("#div_ajout_multiple").hide();
  $("#div_modification").hide();
  $('#add_sous_tache').hover(function() {
    $(this).css('cursor', 'pointer');
  });
  $('#refresh').click(function() {
    window.location.reload();
  });
  $('#sous_tache').focus(function() {
    $('#valider').prop('disabled', false);
  });
  $('#tache').change(function() {
    var valeur = $(this).val();
    $('#valider').prop('disabled', false);
    if (valeur == 'add_simple') {
      $("#step1").hide();
      $("#div_ajout_simple").show();
      $("#div_ajout_multiple").hide();
      $("#div_modification").hide();
      $("#modification").val("simple");
    } else if (valeur == 'add_multiple') {
      $("#step1").hide();
      $("#modification").val("multiple");
      x = 1;
      $("#liste_sous_taches").show();
      $("#div_ajout_multiple").show();
      add_input();
      $("#id_tache").val(valeur);
      $("#div_ajout_simple").hide();
      $("#div_modification").hide();
    } else {
      $("#step1").hide();
      $("#modification").val("modification");
      $("#div_ajout_simple").hide();
      $("#div_ajout_multiple").hide();
      $("#div_modification").show();
      $("#id_tache").val(valeur);
      var type = $("#tache option:selected").data("type");
      var nom_tache = $("#tache option:selected").text();
      nom_tache = nom_tache.replace('🏴 ', '');
      console.log(nom_tache)
      $.ajax({
        url: "php/get_infos_tache.php?type=" + type,
        type: 'GET',
        data: {
          id_tache: valeur
        },
        success: function(data) {
          if (data == '') {
            // ne pas afficher La liste des sous-taches
            $("#liste_sous_taches_modification").hide();
            $("#tache_de_base_modification").val(nom_tache);
          } else {
            $(".input_fields_wrap_modification").append(data);
            $("#tache_de_base_modification").val(nom_tache);
          }
        },
        error: function(err) {
          console.log(err);
        }
      });
    }
  });
  $(add_button).click(function(e) {
    e.preventDefault();
    add_input();
  });

  function add_input() {
    if (x < max_fields) {
      $(wrapper).append('<div id="' + x + '" class="form-group"><label>N°' + x +
        ' - A déplacer</label><p><input class="form-control" type="text" name="mes_taches[]" placeholder="Exemple : Avertir le Client"/><span class="remove_field" style="float:right;text-align:right"><button type="button" class="btn btn-info btn-sm">- Retirer</button></span></p></div>'
      ); //add input box
      x++;
    }
  }
  $(wrapper).on("click", ".remove_field", function(e) {
    e.preventDefault();
    var ancien = x - 1;
    $("#" + ancien).remove();
    x--;
  })
  $(".input_fields_wrap").sortable();
  $(".input_fields_wrap_modification").sortable();
  $("#valider").click(function(event) {
    console.log("ok")
    event.preventDefault();
    var serial = $("#mon_formulaire").serialize();
    console.log(serial);
    // faire les verifs sur les inputs ...
    var type_de_modif = $("#modification").val();
    $.ajax({
      url: "php/ajouter_tache.php", //this is the submit URL
      type: 'GET', //or POST
      data: $("#mon_formulaire").serialize(),
      success: function(data) {
        console.log(data);
        $("#modale_taches").modal("hide");
        window.location.reload();
      }
    });
  })
  $("#delete_tache_and_sous_taches").click(function() {
    var id_tache = $("#id_tache").val();
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
          url: "php/delete_tache.php", //this is the submit URL
          type: 'GET', //or POST
          data: {
            id_tache: id_tache
          },
          success: function(data) {
            console.log(data);
            $("#modale_taches").modal("hide");
            window.location.reload();
          }
        });
      }
    })
  })
});
