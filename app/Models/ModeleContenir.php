<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleContenir extends Model
{
    protected $table = 'contenir co';
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)    
    
    public function nombrePlacesMax($lettreCategorie, $noTraversee)
    {
        return $this->join('traversee tra', 'co.NOBATEAU = tra.NOBATEAU', 'inner')
                    ->join('categorie ca', 'co.LETTRECATEGORIE = ca.LETTRECATEGORIE', 'inner')
                    ->select('co.CAPACITEMAX as max, ca.LIBELLE as libelle')
                    ->where(['co.LETTRECATEGORIE' => $lettreCategorie])
                    ->where(['tra.NOTRAVERSEE' => $noTraversee]);
    }

    public function nombrePlacesMaxParLettre($lettreCategorie, $noTraversee) {
        return $this->join('traversee tra', 'co.NOBATEAU = tra.NOBATEAU', 'inner')
                    ->join('categorie ca', 'co.LETTRECATEGORIE = ca.LETTRECATEGORIE', 'inner')
                    ->select('co.CAPACITEMAX as max')
                    ->where(['co.LETTRECATEGORIE' => $lettreCategorie])
                    ->where(['tra.NOTRAVERSEE' => $noTraversee])
                    ->get()
                    ->getFirstRow();
    }
}