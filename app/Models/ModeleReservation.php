<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleReservation extends Model
{
    protected $table = 'reservation res'; // nom de la table mappée
    /* ci-dessus on indique la table a 'mapper' */
    protected $primaryKey = 'NORESERVATION'; // clé primaire

    protected $useAutoIncrement = true;

    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s) 

    protected $allowedFields = ['NOTRAVERSEE', 'NOCLIENT', 'DATEHEURE', 'MONTANTTOTAL', 'PAYE', 'MODEREGLEMENT'];

    public function ListerReservations($numeroClient)
    {
        $this->join('traversee tra', 'res.NOTRAVERSEE = tra.NOTRAVERSEE', 'inner')
            ->join('liaison li', 'tra.NOLIAISON = li.NOLIAISON', 'inner')
            ->join('port poD', 'li.NOPORT_DEPART = poD.NOPORT', 'inner')
            ->join('port poA', 'li.NOPORT_ARRIVEE = poA.NOPORT', 'inner')
            ->select('res.DATEHEURE as dateRes, res.MONTANTTOTAL as total, res.PAYE as paye, res.NORESERVATION as noRes, tra.DATEHEUREDEPART as dateDepart, tra.NOLIAISON as noLiaison, poD.NOM as portDepart, poA.NOM as portArrivee')
            ->where(['res.NOCLIENT' => $numeroClient])
            ->orderBy('res.DATEHEURE', 'desc');

            return [
                'resultat' => $this->paginate(2),
                'pager' => $this->pager,
            ];
    }
}