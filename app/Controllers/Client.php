<?php
namespace App\Controllers; 

use App\Models\ModeleClient;
use App\Models\ModeleReservation;
use App\Models\ModeleTraversee;
use App\Models\ModeleTarifer;
use App\Models\ModeleType;

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
        $utilisateurRetourne = $ModeleClient->where(['NOCLIENT'=>session()->get('noclient')])->first();     //J'ai supprimé la variable $condition (au cas ou y a probleme)

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
        if (!$this->request->is('post')) {
            $data['TitreDeLaPage'] = 'Valider la réservation';
            session()->set('noTraversee', $noTraversee);    //Pour retenir le numéro de la traversee quand le formulaire sera confirmé
            $ModeleTarifer = new ModeleTarifer();
            $ModeleClient = new ModeleClient();
            $ModeleType = new ModeleType();
            $ModeleTraversee = new ModeleTraversee();

            $data['libelle'] = [];
            $data['traverseeEtLiaison'] = $ModeleTraversee->traverseeEtLiaison(session()->get('noTraversee'));
            $data['tarif'] = $ModeleTarifer->listerTarifsReservation(session()->get('noTraversee'));
            $data['client'] = $ModeleClient->where(['NOCLIENT'=>session()->get('noclient')])->first();

            foreach ($data['tarif'] as $ligne) {
                $data['libelle'][$ligne->lettreCategorie.$ligne->noType] = ($ModeleType->where(['LETTRECATEGORIE'=>$ligne->lettreCategorie, 'NOTYPE'=>$ligne->noType])->first())->LIBELLE;
            }
            return view('Templates/Header')
            . view('Client/vue_reservation', $data);
        }

        $insertion = False;     //bool pour valider que la personne à au moins réservé quelque chose avant d'enregistrer la réservation
        $ModeleReservation = new ModeleReservation();

        foreach ($_POST['txtquantite'] as $uneQuantite) {
            if ($uneQuantite != 0) {     //FAIRE REGLES VALIDATIONS POUR PLACES RESTANTES + FAIRE REQUETE DE RECUPERATION DU PROCHAIN NORESERVATION
                if ($insertion == False) {
                    $nouvNoReservation = ($ModeleReservation->orderBy('NORESERVATION', 'desc')->first())->NORESERVATION + 1; //on récupère 1 fois le prochain noreservation
                }
                $insertion = True;
                //l'ajout dans la table enregistrer         //DEMANDER AU PROF SI ON EST OBLIGE DE FAIRE LES TRUCS DU UC8
            }
        }

        if ($insertion == True) {
            //faire la requete d'ajout dans la table reservation
            //return view('Templates/Header').view('Client/vue_rapportReservation', $data);
        }
        //on renvoie le formulaire avec un nouveau titre
        
    }
}