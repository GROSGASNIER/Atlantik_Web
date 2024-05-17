<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleSecteur extends Model
{
    protected $table = 'secteur sec'; // nom de la table mappée
    /* ci-dessus on indique la table a 'mapper' */
    protected $primaryKey = 'NOSECTEUR'; // clé primaire

    protected $useAutoIncrement = true;

    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s) 

    public function listerSecteurs()
    {
        return $this->select('sec.NOM as nomSecteur, sec.NOSECTEUR as noSecteur')
                    ->orderBy('NOM', 'asc')
                    ->get()
                    ->getResult();
    }
}