<?php

namespace App\Controllers;

use App\Models\Departements;
use App\Models\Employes;
use App\Models\TypeConge;
use App\Models\Conges;
use App\Controllers\Solde;

class Admin extends BaseController
{

    public function __construct() {
        $this->Solde = new Solde();
    }

    public function employes()
    {
        $departementModel = new Departements();
        $employeModel = new Employes();
        $typeCongeModel = new TypeConge();

        $data = [
            'departements' => $departementModel->orderBy('nom', 'ASC')->findAll(),
            'employes' => $employeModel
                ->select('employes.*, departements.nom AS departement_nom')
                ->join('departements', 'departements.id = employes.departement_id', 'left')
                ->orderBy('employes.id', 'DESC')
                ->findAll(),
            'typesConge' => $typeCongeModel->orderBy('libelle', 'ASC')->findAll(),
            'editEmploye' => null,
            'editDepartement' => null,
            'editTypeConge' => null,
        ];

        if ($this->request->getGet('edit_employe')) {
            $data['editEmploye'] = $employeModel->find((int) $this->request->getGet('edit_employe'));
        }

        if ($this->request->getGet('edit_departement')) {
            $data['editDepartement'] = $departementModel->find((int) $this->request->getGet('edit_departement'));
        }

        if ($this->request->getGet('edit_type_conge')) {
            $data['editTypeConge'] = $typeCongeModel->find((int) $this->request->getGet('edit_type_conge'));
        }

        return view('Views/admin/employe', $data);
    }

    public function saveEmploye()
    {
        $model = new Employes();
        $id = (int) $this->request->getPost('id');

        $payload = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'prenom' => trim((string) $this->request->getPost('prenom')),
            'email' => trim((string) $this->request->getPost('email')),
            'password' => (string) $this->request->getPost('password'),
            'role' => (string) $this->request->getPost('role'),
            'departement_id' => (int) $this->request->getPost('departement_id'),
            'date_embauche' => (string) $this->request->getPost('date_embauche'),
            'actif' => $this->request->getPost('actif') ? 1 : 0,
        ];

        if ($id > 0) {
            if ($payload['password'] === '') {
                unset($payload['password']);
            }

            if (! empty($payload['password'])) {
                $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
            }

            $model->update($id, $payload);
        } else {
            $payload['password'] = password_hash($payload['password'], PASSWORD_DEFAULT);
            $model->insert($payload);
        }

        $this->Solde->createSoldesParEmploye($id);
        
        return redirect()->to(base_url('admin/employe'))->with('success', 'Employé enregistré.');
    }

    public function deleteEmploye(int $id)
    {
        (new Employes())->delete($id);

        return redirect()->to(base_url('admin/employe'))->with('success', 'Employé supprimé.');
    }

    public function saveDepartement()
    {
        $model = new Departements();
        $id = (int) $this->request->getPost('id');

        $payload = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'description' => trim((string) $this->request->getPost('description')),
        ];

        if ($id > 0) {
            $model->update($id, $payload);
        } else {
            $model->insert($payload);
        }

        return redirect()->to(base_url('admin/employe'))->with('success', 'Département enregistré.');
    }

    public function deleteDepartement(int $id)
    {
        (new Departements())->delete($id);

        return redirect()->to(base_url('admin/employe'))->with('success', 'Département supprimé.');
    }

    public function saveTypeConge()
    {
        $model = new TypeConge();
        $id = (int) $this->request->getPost('id');

        $payload = [
            'libelle' => trim((string) $this->request->getPost('libelle')),
            'jours_annuels' => (int) $this->request->getPost('jours_annuels'),
            'deductible' => $this->request->getPost('deductible') ? 1 : 0,
        ];

        if ($id > 0) {
            $model->update($id, $payload);
        } else {
            $model->insert($payload);
        }

        return redirect()->to(base_url('admin/employe'))->with('success', 'Type de congé enregistré.');
    }

    public function deleteTypeConge(int $id)
    {
        (new TypeConge())->delete($id);

        return redirect()->to(base_url('admin/employe'))->with('success', 'Type de congé supprimé.');
    }

    public function approveConge(int $id)
    {
        $model = new Conges();
        $comment = (string) $this->request->getPost('commentaire_rh');

        $payload = [
            'statut' => 'approuvee',
            'commentaire_rh' => $comment,
            'traiter_par' => 'RH',
        ];

        $model->update($id, $payload);

        return redirect()->back()->with('success', 'Demande approuvée.');
    }

    public function rejectConge(int $id)
    {
        $model = new Conges();
        $comment = (string) $this->request->getPost('commentaire_rh');

        $payload = [
            'statut' => 'refusee',
            'commentaire_rh' => $comment,
            'traiter_par' => 'RH',
        ];

        $model->update($id, $payload);

        return redirect()->back()->with('success', 'Demande refusée.');
    }
}
