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
} // Fin Classe