<?php 
namespace App\Controllers;

use App\Models\TypeConge;

class Employe extends BaseController 
{
    protected $TypeConge;

    public function __construct() {
            $this->TypeConge = new TypeConge();
        }

        private function findOrFail($id) {
            $typeconge = $this->TypeConge->find($id);
            if($typeconge == null) {
                throw new PageNotFoundException("TypeConge non trouvé");
            }
            return $typeconge;
        }
        private function getFormData() {
            return [
                "libelle" => $this->request->getPost("libelle"),
                "jours_annuels" => $this->request->getPost("jours_annuels"),
                "deductible" => $this->request->getPost("deductible")
            ];
        }

        public function getAllObjectifs() {
            $data["Typeconge"] = $this->TypeConge->findAll();
            return view("employe/create",$data);
        }
        public function getTypecongeById($id) {
            $data["Typeconge"] = $this->findOrFail($id);
            return view("Typeconge/Element",$data);
        }
        public function createTypeconge() {
            $data = $this->getFormData();
            $this->TypeConge->insert($data);
            return redirect()->to("/Typeconge");
        }
        public function updateTypeconge($id) {
            $data = $this->getFormData();

            $this->findOrFail($id);
            $this->TypeConge->update($id,$data);
            return redirect()->to("/Typeconges");
        } 
        public function deleteTypeconge($id) {
            $this->findOrFail($id);
            $this->TypeConge->delete($id);
            return redirect()->to("/Typeconge");
        }
}
?>