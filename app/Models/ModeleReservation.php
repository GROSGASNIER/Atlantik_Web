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
        return $this->join('traversee tra', 'res.NOTRAVERSEE = tra.NOTRAVERSEE', 'inner')
            ->select('res.DATEHEURE as dateRes, res.MONTANTTOTAL as total, res.PAYE as paye, res.NORESERVATION as noRes, tra.DATEHEUREDEPART as dateDepart, tra.NOLIAISON as noLiaison')
            ->where(['res.NOCLIENT' => $numeroClient])
            ->orderBy('res.DATEHEURE', 'desc')            
            ->get()
            ->getResult();
    }
}