<?php 
    namespace App\Controllers;

    use App\Models\Departements;
    use CodeIgniter\Exceptions\PageNotFoundException;

    class DepartementController extends BaseController {
        protected $departementModel;

        public function __construct() {
            $this->departementModel = new Departements();
        }

        private function findOrFail($id) {
            $departement = $this->departementModel->find($id);
            if($departement == null) {
                throw new PageNotFoundException("Dempartement non trouvé");
            }
            return $departement;
        }
        private function getFromData() {
            return [
                "nom" =>$this->request->getPost("nom"),
                "description" => $this->request->getPost("description")
            ];
        }

        public function getAllDepartement() {
            $data["departement"] = $this->departementModel->findAll();
            return view("departement/liste",$data);
        }
        public function getDepartementById($id) {
            $data["departement"] = $this->findOrFail($id);
            return view("departement/element",$data);
        }
        public function createDepartement() {
            $data = $this->getFromData();

            $this->departementModel->insert($data);
            return redirect()->to("/departement");
        }
        public function updateDepartement($id) {
            $data = $this->getFromData();
            
            $this->findOrFail($id);
            $this->departementModel->update($id,$data);
            return redirect()->to("/departement");
        }
        public function deleteDepartement($id) {
            $this->findOrFail($id);
            $this->departementModel->delete($id);
            return redirect()->to("/departement");
        }
    }
?>