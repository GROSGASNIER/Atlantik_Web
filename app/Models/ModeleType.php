<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleType extends Model
{
    protected $table = 'type ty';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
} // Fin Classe