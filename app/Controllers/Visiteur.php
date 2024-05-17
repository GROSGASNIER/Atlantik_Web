<?php
namespace App\Controllers; 

use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleTarifer;
use App\Models\ModeleSecteur;

helper(['url', 'assets', 'form']);

class Visiteur extends BaseController
{
    public function Accueil()
    {        
        return view('Templates/Header')
        .view('Visiteur\vue_accueil.php');
    }

    public function RedirigeVers($laBonneRoute)
    {
        return redirect()->route($laBonneRoute);
    }

    public function Connection()
    {        
        helper(['form']);
        $data['TitreDeLaPage'] = 'Se connecter';

        if(is_null(session()->get('url'))) {
            session()->set('url', previous_url(true));
        }

        if (!$this->request->is('post')) {
            return view('Templates/Header', $data)
            .view('Visiteur/vue_connection');
        }

        $reglesValidation = [
            'txtMel' => 'required|valid_email',
            'txtMotDePasse' => 'required',          //pas de règles de mots de passe pour l'instant pour simplifier et car il n'y en avait pas de base
        ];
        if (!$this->validate($reglesValidation)) { 
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            .view('Visiteur/vue_connection');
        }

        $Mel = $this->request->getPost('txtMel');
        $MdP = $this->request->getPost('txtMotDePasse');

        $ModeleClient = new ModeleClient();
        $condition = ['MEL'=>$Mel,'MOTDEPASSE'=>$MdP];
        $utilisateurRetourne = $ModeleClient->where($condition)->first();

        if ($utilisateurRetourne != null) {
            session()->set('noclient', $utilisateurRetourne->NOCLIENT);         //pour l'instant pas de msg pour indoquer que l'on est connecté
            session()->set('nom', $utilisateurRetourne->NOM);
            session()->set('prenom', $utilisateurRetourne->PRENOM);
            return redirect()->to(session()->get("url"));

        } else {
            $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
            return view('Templates/Header', $data)
            .view('Visiteur/vue_connection');
        }
    }

    public function CreerUnCompte()
    {
        if(is_null(session()->get('url'))) {                #Problème : si quelqu'un abandonne la création de son compte, la variable de session ne sera pas détruite ni changée
            session()->set('url', previous_url(true));
        }

        $data['TitreDeLaPage'] = 'Créer un compte';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Visiteur/vue_creerUnCompte', $data);
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
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header')
            . view('Visiteur/vue_creerUnCompte', $data);
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

        if ($modelClient->insert($donneesAInserer, false)) {
            $condition = ['MEL'=>$mel,'MOTDEPASSE'=>$mdp];
            $utilisateurRetourne = $modelClient->where($condition)->first();
            session()->set('noclient', $utilisateurRetourne->NOCLIENT);         //pour l'instant pas de msg pour indoquer que l'on est connecté
            session()->set('nom', $utilisateurRetourne->NOM);
            session()->set('prenom', $utilisateurRetourne->PRENOM);
        }        
        return view('Templates/Header')
            .view('Client/vue_rapportAjout');
    }

    public function Liaisons() 
    {
        $modeleLiaison = new modeleLiaison();
        $data['listeLiaisons'] = $modeleLiaison->LiaisonsParSecteur();
        $data['TitreDeLaPage'] = 'Liste des liaisons par secteur';        

        return view('Templates/Header')
        .view('Visiteur/vue_liaisons', $data);
    }

    public function Tarifs($noLiaison = null)
    {
        $modeleTarifer = new modeleTarifer();
        $data['TitreDeLaPage'] = 'Liste des tarifs de la liaison n°' .$noLiaison;
        #$data['listePeriodes'] = a;
        $data['listeTarifs'] = $modeleTarifer->ListerTarifs($noLiaison);        

        return view('Templates/Header')
        .view('Visiteur/vue_tarifs', $data);
    }

    public function horairesTraversees($noSecteur = null)
    {
        $data['TitreDeLaPage'] = 'Veuillez séléctionner un secteur pour en choisir une liaison';
        
        $modeleSecteur = new ModeleSecteur();
        $data['secteursRetournes'] = $modeleSecteur->listerSecteurs();

        if (is_null($noSecteur))            //Je retourne d'abord les secteurs tout seuls si l'on n'en a pas selectionné
        {
            return view('Templates/Header')
            .view('Visiteur/vue_horaires', $data);
        }

        $modeleLiaison = new ModeleLiaison();
        $data['liaisonsRetournees'] = $modeleLiaison->LiaisonsDUnSecteur($noSecteur);

        if (!$this->request->is('post')) {      //Quand le formulaire n'a pas été retourné
            $data['TitreDeLaPage'] = 'Veuillez séléctionner une liaison et une date';
            return view('Templates/Header')
            .view('Visiteur/vue_horaires', $data);
        }

        $noLiaison = $this->request->getPost('txtnoLiaison');
        $date = $this->request->getPost('txtdate');


    }
}