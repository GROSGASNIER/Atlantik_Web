<br><br><br>
<?php
if(!is_null(session()->get('prenom'))) {
    echo 'Ajout effectué. Vous êtes maintenant connecté';
    echo '<br><br><br><p><a href="' .session()->get('url'). '">Retour à la page précédente</a></p>';
} else {
    echo 'Echec ajout.';
    echo '<br><br><br><p><a href="creerUnCompte">Retour à la page de création de compte</a></p>';
}