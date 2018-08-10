$(function() {
  //$(".petite_tache").css("cursor", "move");
  $(".enveloppe").sortable();
  $('#liste_projets').click(function() {
    window.location = "index.php";
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
        $.ajax({
          url: "php/modifier_projet.php", //this is the submit URL
          type: 'GET', //or POST
          data: {
            id_projet: id_projet,
            manager: nom_prenom,
            id_manager: id_manager
          },
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    },
    requestDelay: 400
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
        $('#client').val(nom_prenom);
        $('#id_client').val(id_manager);
        $.ajax({
          url: "php/modifier_projet.php", //this is the submit URL
          type: 'GET', //or POST
          data: {
            id_projet: id_projet,
            client: nom_prenom,
            id_client: id_client
          },
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    },
    requestDelay: 400
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
        $('#id_tech').val(id_manager);
        $.ajax({
          url: "php/modifier_projet.php", //this is the submit URL
          type: 'GET', //or POST
          data: {
            id_projet: id_projet,
            tech: nom_prenom,
            id_tech: id_client
          },
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    },
    requestDelay: 400
  };
  var options_recherche_tache = {
    url: function(phrase) {
      return "php/recherche_tache_and_sous_tache.php?type=manager";
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
    list: {
      maxNumberOfElements: 6,
      match: {
        enabled: true
      },
      onChooseEvent: function(item) {
        var id_tache = $("#recherche_tache").getSelectedItemData().idt;
        $('#id_tache').val(id_tache);
        var id_stache = $("#recherche_tache").getSelectedItemData().idst;
        $('#id_stache').val(id_stache);
        var type = $("#recherche_tache").getSelectedItemData().type;
        $('#type_de_tache_selected').val(type);
        $('#valider_affectation').prop('disabled', false);
        var id_projet = $('#id_projet').val();
        var tache = $("#recherche_tache").getSelectedItemData().visuel;
        tache = tache.replace('🏴 ', '');
        $('#step1_affectation').hide();
        if (type == 'Tâche complexe') {
          console.log('cest une tache complexe');
          // ajax pour remplir step2_affectation
          $.ajax({
            url: "php/recherche_sous_taches_from_tache.php?id_tache=" + id_tache, //this is the submit URL
            type: 'GET', //or POST
            success: function(data) {
              console.log(data);
              if (data) {
                $('#step2_affectation').show();
                $("#step2_affectation").html(data);
              }
            }
          });
          $('#step3_affectation').show();
        } else if (type == 'Tâche simple') {
          console.log('cest une tache simple');
          $('#step4_affectation').show();
          $('#step3_affectation').show();
        } else {
          console.log('cest une sous-tache');
          $('#step2_affectation').hide();
          $('#step3_affectation').show();
          $('#step4_affectation').show();
        }
        //$('#recherche_tache').val(tache);
      }
    },
    requestDelay: 400,
    adjustWidth: false
  };
  $('#recherche_tache').easyAutocomplete(options_recherche_tache);
  $("#manager").easyAutocomplete(options_manager);
  $("#client").easyAutocomplete(options_client);
  $("#tech").easyAutocomplete(options_tech);
  $("#nom").blur(function() {
    var nom = $("#nom").val();
    console.log(nom);
    var id_projet = $('#id_projet').val();
    $.ajax({
      url: "php/modifier_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: {
        id_projet: id_projet,
        nom: nom
      },
      success: function(data) {
        console.log(data);
        window.location.reload();
      }
    });
  })
  $("#commentaires").blur(function() {
    var commentaires = $("#commentaires").val();
    console.log(commentaires);
    var id_projet = $('#id_projet').val();
    $.ajax({
      url: "php/modifier_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: {
        id_projet: id_projet,
        commentaires: commentaires
      },
      success: function(data) {
        console.log(data);
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
  $("#date_debut").change(function() {
    var date_debut = $(this).val()
    var id_projet = $('#id_projet').val();
    $.ajax({
      url: "php/modifier_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: {
        id_projet: id_projet,
        date_debut: date_debut
      },
      success: function(data) {
        console.log(data);
        window.location.reload();
      }
    });
  });
  $("#date_installation").change(function() {
    var date_installation = $(this).val()
    var id_projet = $('#id_projet').val();
    $.ajax({
      url: "php/modifier_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: {
        id_projet: id_projet,
        date_installation: date_installation
      },
      success: function(data) {
        console.log(data);
        window.location.reload();
      }
    });
  });
  $("#etat").change(function() {
    var etat = $(this).val()
    var id_projet = $('#id_projet').val();
    $.ajax({
      url: "php/modifier_projet.php", //this is the submit URL
      type: 'GET', //or POST
      data: {
        id_projet: id_projet,
        etat: etat
      },
      success: function(data) {
        console.log(data);
        window.location.reload();
      }
    });
  })
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
      var nom_tache = $("#tache option:selected").text();
      nom_tache = nom_tache.replace('🏴 ', '');
      console.log(nom_tache);
      $.ajax({
        url: "php/get_infos_tache.php",
        type: 'GET',
        data: {
          id_tache: valeur
        },
        success: function(data) {
          if (data == '') {
            // ne pas afficher La liste des sous-taches
            $("#liste_sous_taches_modification").hide();
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
