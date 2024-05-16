<br><br><br>
<?php
#faire comme dans l'exxemple du cours
if ($reussite) { // true (1) si ajout, false (0) sinon
    echo 'Modification du compte effectuée';
    echo '<br><br><br><p><a href="' .session()->get('url'). '">Retour à la page précédente</a></p>';
} else {
    echo 'Echec de la modification';
    echo '<br><br><br><p><a href="modifierCompte">Retour à la page de modification de compte</a></p>';
}