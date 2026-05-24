<?php 
namespace App\Controllers;

use App\Models\Conges;

class RessourceH extends BaseController {
    private $Conges;

    public function __construct() {
        $this->Conges = new Conges();   
    }

    public function getAllCongeAttente() {
        
        $data['CongeAttente']= $this->Conges->where('statut', 'En attente')->findAll();

        return view('rh/index', $data);
    }

    public function traiterConge() {
        $id_conge = $this->request->getPost('id_conge');
        $action = $this->request->getPost('action');

        if ($id_conge) {

            if ($action == "approuve") {
                    $statut_modifie = [
                    'statut' => 'approuve' 
                ];
            } else {
                $statut_modifie = [
                    'statut' => 'refuse' 
                ];
            }
            
        }

        $this->Conges->update($id_conge,$statut_modifie);

        return redirect()->to(base_url('rh/list'));
    }
}
?>