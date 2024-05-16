<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleLiaison extends Model
{
    protected $table = 'liaison li';
    protected $primaryKey = 'NOLIAISON'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    public function LiaisonsParSecteur()
    {
        return $this->join('secteur sec', 'li.NOSECTEUR = sec.NOSECTEUR', 'inner')
                    ->join('port poD', 'li.NOPORT_DEPART = poD.NOPORT', 'inner')
                    ->join('port poA', 'li.NOPORT_ARRIVEE = poA.NOPORT', 'inner')
                    ->select('li.NOLIAISON as code, poD.NOM as portDepart, poA.NOM as portArrivee, sec.NOM as secteur, li.DISTANCE as distance')
                    ->orderBy('secteur', 'asc')
                    ->get()
                    ->getResult();
    }

    public function PortsDUneLiaison($noLiaison)
    {
        return $this->join('port poD', 'li.NOPORT_DEPART = poD.NOPORT', 'inner')
                    ->join('port poA', 'li.NOPORT_ARRIVEE = poA.NOPORT', 'inner')
                    ->select('poD.NOM as portDepart, poA.NOM as portArrivee')
                    ->where(['li.NOLIAISON' => $noLiaison])
                    -get()
                    ->getResult();
    }
} // Fin Classe