<?php 
namespace App\BaseController;

use App\Models\Conges;

class RessourceH extends BaseController {
    private $Conges;

    public function getAllCongeAttente() {
        $data['CongeAttente']= $this->$Conges->where('statut', 'attente')->findAll();

        return view('rh/index', $data);
    }
}
?>