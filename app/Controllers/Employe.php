<?php 
namespace App\Controllers;

use App\Models\TypeConge;
use App\Models\Conges;
use CodeIgniter\Exceptions\PageNotFoundException; // Ne pas oublier l'import pour éviter les crashs

class Employe extends BaseController 
{
    protected $TypeConge;
    protected $Conges; 

    // 1. UN SEUL CONSTRUCTEUR POUR LES DEUX MODÈLES
    public function __construct() {
        $this->TypeConge = new TypeConge();
        $this->Conges = new Conges();
    }

    // ==========================================
    // BLOC : TYPES DE CONGÉ
    // ==========================================

    private function findTypeCongeOrFail($id) {
        $typeconge = $this->TypeConge->find($id);
        if($typeconge == null) {
            throw new PageNotFoundException("TypeConge non trouvé");
        }
        return $typeconge;
    }

    private function getTypeCongeFormData() {
        return [
            "libelle" => $this->request->getPost("libelle"),
            "jours_annuels" => $this->request->getPost("jours_annuels"),
            "deductible" => $this->request->getPost("deductible")
        ];
    }

    public function getAllTypeConge() {
        // On récupère la liste des types de congés pour remplir ton <select>
        $data["Typeconge"] = $this->TypeConge->findAll();
        return view("employe/create", $data);
    }

    public function createTypeconge() {
        $data = $this->getTypeCongeFormData();
        $this->TypeConge->insert($data);
        return redirect()->to("/Typeconge");
    }

    public function updateTypeconge($id) {
        $data = $this->getTypeCongeFormData();
        $this->findTypeCongeOrFail($id);
        $this->TypeConge->update($id, $data);
        return redirect()->to("/Typeconges");
    } 

    public function deleteTypeconge($id) {
        $this->findTypeCongeOrFail($id);
        $this->TypeConge->delete($id);
        return redirect()->to("/Typeconge");
    }


    // ==========================================
    // BLOC : DEMANDES DE CONGÉS (L'EMPLOYÉ)
    // ==========================================

    // C'est cette méthode qui charge ton formulaire de demande !
    public function getAllConge() {
        
        // Si tu as aussi besoin de l'historique des demandes de l'employé sur la page :
        $data["Conges"] = $this->Conges->findAll(); 

        return view("employe/index", $data);
    }

    public function CountConge() {
        // Compteur du nombre de conges 
        $data["Nb_conge"]= (int)$this->Conges->countAllResults();

        return view("employe/dashboard", $data);
    }

    private function findCongeOrFail($id) {
        $conge = $this->Conges->find($id);
        if($conge == null) {
            throw new PageNotFoundException("Demande de congé non trouvée");
        }
        return $conge;
    }

    private function getCongeFormData() {
        return [
            "employe_id"        => $this->request->getPost("employe_id"), // adapter selon tes colonnes de la table conge
            "type_conge_id"     => $this->request->getPost("type_conge_id"),
            "date_debut"        => $this->request->getPost("date_debut"),
            "date_fin"          => $this->request->getPost("date_fin"),
            "nb_jours"          => $this->request->getPost("nb_jours"),
            "motif"             => $this->request->getPost("motif"),
            "statut"            => $this->request->getPost("statut"),
            "commentaire_rh"    => $this->request->getPost("commentaire_rh"),
            "created_at"        => $this->request->getPost("created_at"),
            "traiter_par"       => $this->request->getPost("traiter_par"),
        ];
    }

    // Pour enregistrer une nouvelle demande de congé soumise par l'employé
    public function storeConge() {
        $data = $this->getCongeFormData();
        $this->Conges->insert($data);
        return redirect()->to("/employe/index"); // ou vers ton tableau de bord
    }
}