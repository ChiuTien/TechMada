<?php

namespace App\Models;

use CodeIgniter\Model;

class Employes extends Model{
    protected $table = "employes";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [
        "nom",
        "prenom",
        "email",
        "password",
        "role",
        "dempartement_id",
        "date_embauche",
        "actif"
    ];
}
