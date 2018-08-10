## Démonstration V3
Lien de l'espace de démonstration : https://mon-chatbot.com/taches/<br /><br />

## Structure de la base données
Lien vers le fichier .sql : https://github.com/MathieuDuboy/taches_v3/blob/master/of2ds84i_wp587.sql<br /><br />

## Configuration : 
### Basic :
Bootsrap + jQuery + jQuery UI + EasyAutocomplete + SweetAlert2 + <br /><br />

### SQL
Modifier les variables du fichier config.php : https://github.com/MathieuDuboy/taches_v3/blob/master/php/config.php<br /><br />

### Mail :
Modifier l'adresse mail d'envoi + mot de passe : https://github.com/MathieuDuboy/taches_v3/blob/master/php/ajouter_projet.php<br /><br />

### Tâches CRON : 
Modifier l'adresse mail d'envoi + mot de passe + écart de recherche des données ici :<br />
**Envoi de données journalier concernant les nouvelles affectations :**
https://github.com/MathieuDuboy/taches_v3/blob/master/cron_taches_affectation.php<br />
**Envoi de données journalier concernant les tâches arrivant à expiration :** https://github.com/MathieuDuboy/taches_v3/blob/master/cron_taches_expiration.php<br /><br />

### CHMOD dossier d'upload : 
IL faut configurer le CHMOD du dossier php/uploads en 755 ou 777 pour permettre l'upload des documents et images.<br /><br />










