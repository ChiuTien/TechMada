<?php 

namespace App\Controllers;

use App\Models\Soldes;
use App\Models\TypeConge;

class Solde extends BaseController {

    private function __construct() {
        $this->Soldes = new Soldes();
        $this->TypeConge = new TypeConge();
    }

    public function createSoldesParEmploye($employe) {
        $AllConges = $this->TypeConge->findAll();

        $annee = date('Y');

        foreach ($AllConges as $ac) {
            $dataSoldes = [
                'employe_id' => $employe['id'],
                'type_conge_id' => $ac['id'],
                'annee' => $annee,
                'jours_attribues' => $ac['jours_annuels'],
                'jours_pris' => 0
            ];
        }

        return $this->Soldes->insert($dataSoldes);
    }
}


?>