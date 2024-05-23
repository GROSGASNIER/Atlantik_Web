<?php
namespace App\Controllers; 

use App\Models\ModeleClient;
use App\Models\ModeleReservation;
use App\Models\ModeleTraversee;

helper(['url', 'assets', 'form']);

class Client extends BaseController
{
    public function Deconnection()
    {
        session()->destroy();
        return redirect()->to('');
    } // Fin seDeconnecter

    public function ModifierCompte() 
    {
        $ModeleClient = new ModeleClient();
        $condition = ['NOCLIENT'=>session()->get('noclient')];
        $utilisateurRetourne = $ModeleClient->where($condition)->first();

        $data['txtNom'] = $utilisateurRetourne->NOM;
        $data['txtPrenom'] = $utilisateurRetourne->PRENOM;
        $data['txtAdresse'] = $utilisateurRetourne->ADRESSE;
        $data['txtCodePostal'] = $utilisateurRetourne->CODEPOSTAL;
        $data['txtVille'] = $utilisateurRetourne->VILLE;
        $data['txtNumFixe'] = $utilisateurRetourne->TELEPHONEFIXE;
        $data['txtNumMobile'] = $utilisateurRetourne->TELEPHONEMOBILE;
        $data['txtMel'] = $utilisateurRetourne->MEL;
        $data['txtMDP'] = $utilisateurRetourne->MOTDEPASSE;

        if(is_null(session()->get('url'))) {
            session()->set('url', previous_url(true));
        }

        $data['TitreDeLaPage'] = 'Modification du compte';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Client/vue_modifierCompte', $data);
        }

        $reglesValidation = [
            'txtNom' => 'required|alpha_space|alpha_dash',
            'txtPrenom' => 'required|alpha_space|alpha_dash',
            'txtVille' => 'required|alpha_space|alpha_dash',
            'txtCodePostal' => 'required',      //mieux vaut avoir une table avec les différents code postaux a cause des départements de la Corse
            'txtAdresse' => 'required|alpha_space|alpha_dash|alpha_numeric',
            'txtNumFixe' => 'permit_empty|numeric',
            'txtNumMobile' => 'permit_empty|numeric',
            'txtMel' => 'required|valid_email',
            'txtMDP' => 'required',
            'txtMDPConfirmation' => 'required|matches[txtMDP]',
        ];

        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé, on renvoie le formulaire */
            $data['TitreDeLaPage'] = "Saisie incorrecte, veuillez réessayer";
            return view('Templates/Header')
            . view('Client/vue_modifierCompte', $data);
        }

        $donneesAInserer = array(
            'NOM' => $this->request->getPost('txtNom'),
            'PRENOM' => $this->request->getPost('txtPrenom'),
            'ADRESSE' => $this->request->getPost('txtAdresse'),
            'CODEPOSTAL' => $this->request->getPost('txtCodePostal'),
            'VILLE' => $this->request->getPost('txtVille'),
            'TELEPHONEFIXE' => $this->request->getPost('txtNumFixe'),
            'TELEPHONEMOBILE' => $this->request->getPost('txtNumMobile'),
            $mel = $this->request->getPost('txtMel'),
            'MEL' => $mel,
            $mdp = $this->request->getPost('txtMDP'),
            'MOTDEPASSE' => $mdp,
        ); // reference, libelle, prixht, quantiteenstock, image : champs de la table 'produit'

        $modelClient = new ModeleClient(); //instanciation du modèle
        $condition = ['NOCLIENT'=>session()->get('noclient')];

        $commande = $modelClient
            ->where($condition)
            ->set($donneesAInserer)
            ->update();
        if ($commande) {
            $utilisateurRetourne = $modelClient->where($condition)->first();
            session()->set('noclient', $utilisateurRetourne->NOCLIENT);         //pour l'instant pas de msg pour indoquer que l'on est connecté
            session()->set('nom', $utilisateurRetourne->NOM);
            session()->set('prenom', $utilisateurRetourne->PRENOM);
            $data['reussite'] = true;
        }        
        return view('Templates/Header')
            .view('Client/vue_rapportModification', $data);
    }

    public function HistoriqueReservations()
    {
        $modeleReservation = new ModeleReservation();
        $data['TitreDeLaPage'] = 'Historique des réservation';
        $resultat = $modeleReservation->ListerReservations(session()->get('noclient'));
        $data['historique'] = $resultat['resultat'];
        $data['pager'] = $resultat['pager'];
        return view('Templates/Header')
        .view('Client/vue_historiqueReservations', $data);
    }

    public function reserverTraversee($noTraversee) 
    {

    }
}