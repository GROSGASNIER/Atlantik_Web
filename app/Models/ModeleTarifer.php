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
} // Fin Classe

/*select DISTINCT TARIF, categorie.LIBELLE, tarifer.LETTRECATEGORIE, type.LIBELLE, tarifer.NOTYPE, periode.DATEDEBUT, periode.DATEFIN
from tarifer
inner join type on tarifer.NOTYPE = type.NOTYPE
inner join periode on tarifer.NOPERIODE = periode.NOPERIODE
inner join categorie on tarifer.LETTRECATEGORIE = categorie.LETTRECATEGORIE
where NOLIAISON = 1*/   