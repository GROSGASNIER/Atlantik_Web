<?php
namespace App\Controllers; 

class Affiche extends BaseController
{
    public function Header()
    {
        return view('Templates/HeaderVisiteur');
        /* retour de la vue : "vue_bonjour" du dossier "Test" situé dans "Views" (pas d'affichage dans le contrôleur !) */
    }
}