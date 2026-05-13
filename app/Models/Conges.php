<?php 
    namespace App\Models;

    use CodeIgniter\Model;

    class Conges extends Model {
        protected $table = "conges";
        protected $primaryKey = "id";
        protected $allowedFields = [
            "employe_id",
            "type_conge_id",
            "date_debut",
            "date_fin",
            "nb_jours",
            "motif",
            "statut",
            "commentaire_rh",
            "created_at",
            "traiter_par"
        ];
    }
?>