<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleTraversee extends Model
{
    protected $table = 'traversee tra';
    protected $primaryKey = 'NOTRAVERSEE'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['NOLIAISON','NOBATEAU', 'DATEHEUREDEPART','DATEHEUREARRIVEE'];

    public function listerTraverseeEtPlaces($noLiaison, $date) {
        return $this->join('bateau ba', 'tra.NOBATEAU = ba.NOBATEAU', 'inner')
                    ->select('tra.NOTRAVERSEE as noTraversee, tra.DATEHEUREDEPART as heureDepart, ba.NOM as bateau')
                    ->where(['tra.noLiaison' => $noLiaison])
                    ->like(['tra.DATEHEUREDEPART' => $date])
                    ->get()
                    ->getResult();
    }

    public function traverseeEtLiaison($noTraversee) {
        return $this->join('liaison li', 'tra.NOLIAISON = li.NOLIAISON', 'inner')
                    ->join('port poD', 'li.NOPORT_DEPART = poD.NOPORT', 'inner')
                    ->join('port poA', 'li.NOPORT_ARRIVEE = poA.NOPORT', 'inner')
                    ->select('tra.NOTRAVERSEE as numeroTraversee, tra.DATEHEUREDEPART as dateDepart, poD.NOM as portDepart, poA.NOM as portArrivee')
                    ->where(['tra.NOTRAVERSEE' => $noTraversee])
                    ->get()
                    ->getResult();
    }
} // Fin Classe