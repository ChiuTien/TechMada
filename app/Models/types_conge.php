<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Types_conge extends Model {
        protected $table = "types_conge";
        protected $primaryKey = "id";
        protected $allowedFields = [
            "libelle",
            "jours_annuels",
            "deductible"
        ];
    }
?>