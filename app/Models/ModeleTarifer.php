<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleTarifer extends Model
{
    protected $table = 'tarifer ta';
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    
    public function ListerPeriodes($numeroLiaison)
    {
        return $this->join('periode pe', 'ta.NOPERIODE = pe.NOPERIODE', 'inner')    #utiliser apres un compteur de périodes dans la vue
                    ->distinct('pe as code, poD.NOM as portDepart, poA.NOM as portArrivee, sec.NOM as secteur, li.DISTANCE as distance');   #NE PAS UTILISER COMME CA
    }
    
    public function ListerTarifs($numeroLiaison)
    {
        return $this->join('periode pe', 'ta.NOPERIODE = pe.NOPERIODE', 'inner')
                    ->join('categorie ca', 'ta.LETTRECATEGORIE = ca.LETTRECATEGORIE', 'inner')
                    ->join('type ty', 'ta.NOTYPE = ty.NOTYPE', 'inner')
                    ->select('ta.TARIF as tarif, ca.LIBELLE as libelleCategorie, ta.LETTRECATEGORIE as lettre, ty.LIBELLE as libelleType, ta.NOTYPE as numeroType, pe.DATEDEBUT as dateDebut, pe.DATEFIN as dateFin')
                    ->where(['NOLIAISON' => $numeroLiaison])
                    ->get()
                    ->getResult();
    }

    public function listerTarifsReservation($numeroTraversee)
    {
        return $this->join('traversee tra', 'ta.NOLIAISON = tra.NOLIAISON', 'inner')            //il faut chercher plus tard dans le controller le libelle du type
                    ->join('periode pe', 'ta.NOPERIODE = pe.NOPERIODE', 'inner')
                    ->select('ta.TARIF as tarif, ta.NOTYPE as noType, ta.LETTRECATEGORIE as lettreCategorie')
                    ->where(['tra.NOTRAVERSEE' => $numeroTraversee])
                    ->where('tra.DATEHEUREDEPART >= pe.DATEDEBUT')
                    ->where('tra.DATEHEUREDEPART <= pe.DATEFIN')                    
                    ->get()
                    ->getResult();
    }
}