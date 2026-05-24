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

    public function approuverConge() {
        $id_conge = $this->request->getPost('id_conge');

        if ($id_conge) {
            $statut_modifie = [
                'statut' => 'approuve' 
            ];
        }

        $this->Conges->update($id_conge,$statut_modifie);

        return redirect()->to(base_url('rh/list'));
    }
}
?>