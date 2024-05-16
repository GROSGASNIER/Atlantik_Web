<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleTraversee extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'NOPERIODE '; // clé primaire
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
    protected $allowedFields = ['DATEDEBUT','DATEFIN'];
} // Fin Classe