<?php
$departements = $departements ?? [];
$employes = $employes ?? [];
$typesConge = $typesConge ?? [];
$editEmploye = $editEmploye ?? null;
$editDepartement = $editDepartement ?? null;
$editTypeConge = $editTypeConge ?? null;

$editEmployeId = $editEmploye['id'] ?? '';
$editDepartementId = $editDepartement['id'] ?? '';
$editTypeCongeId = $editTypeConge['id'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <title>Administration — TechMada RH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="<?= base_url('css/project.css') ?>" rel="stylesheet"/>
</head>
<body>
<section id="page-admin-employes" style="margin-top:3rem">
<div class="app-wrap">

  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-logo-icon" style="background:var(--ink);border:1px solid rgba(255,255,255,.15)"><i class="bi bi-shield-check" style="color:var(--leaf)"></i></div>
      <div class="sidebar-brand-name">TechMada RH<span>Administration</span></div>
    </div>
    <ul class="sidebar-nav" style="margin-top:1rem">
      <li><a href="#page-admin-employes" class="active"><i class="bi bi-people"></i> Employés</a></li>
      <li><a href="#page-admin-departements"><i class="bi bi-building"></i> Départements</a></li>
      <li><a href="#page-admin-types-conge"><i class="bi bi-tags"></i> Types de congé</a></li>
    </ul>
    <div class="sidebar-user">
      <div class="s-user-row">
        <div class="avatar" style="background:#5a2d82;width:32px;height:32px;font-size:.7rem">AD</div>
        <div><div class="user-name">Administrateur</div><div class="user-role">Admin système</div></div>
      </div>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Gestion administrative</div>
        <div class="topbar-breadcrumb">Employés, départements et types de congé</div>
      </div>
      <div class="topbar-actions" style="flex-wrap:wrap;gap:8px">
        <a href="#page-admin-employes" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-people"></i> Employés</a>
        <a href="#page-admin-departements" class="btn-secondary" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-building"></i> Départements</a>
        <a href="#page-admin-types-conge" class="btn-secondary" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-tags"></i> Types</a>
      </div>
    </div>

    <div class="content">
      <?php if (session()->getFlashdata('success')): ?>
        <div class="flash flash-success">
          <i class="bi bi-check-circle-fill"></i>
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="flash flash-error">
          <i class="bi bi-exclamation-circle-fill"></i>
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <div class="form-section" id="page-admin-employes">
        <h3><i class="bi bi-person-plus" style="color:var(--forest);margin-right:6px"></i><?= $editEmploye ? 'Modifier l’employé' : 'Ajouter un employé' ?></h3>
        <form action="<?= base_url('admin/employe/save') ?>" method="post">
          <input type="hidden" name="id" value="<?= esc($editEmployeId) ?>"/>
          <div class="form-grid-2" style="margin-bottom:1rem">
            <div class="f-group">
              <label class="f-label">Prénom</label>
              <input type="text" name="prenom" class="f-input" placeholder="Jean" value="<?= esc($editEmploye['prenom'] ?? '') ?>" required/>
            </div>
            <div class="f-group">
              <label class="f-label">Nom</label>
              <input type="text" name="nom" class="f-input" placeholder="Rakoto" value="<?= esc($editEmploye['nom'] ?? '') ?>" required/>
            </div>
            <div class="f-group">
              <label class="f-label">Email</label>
              <input type="email" name="email" class="f-input" placeholder="jean.rakoto@techmada.mg" value="<?= esc($editEmploye['email'] ?? '') ?>" required/>
            </div>
            <div class="f-group">
              <label class="f-label">Mot de passe <?= $editEmploye ? '(laisser vide pour conserver)' : 'initial' ?></label>
              <input type="password" name="password" class="f-input" placeholder="Mot de passe" <?= $editEmploye ? '' : 'required' ?>/>
            </div>
            <div class="f-group">
              <label class="f-label">Département</label>
              <select name="departement_id" class="f-select" required>
                <option value="">Sélectionner</option>
                <?php foreach ($departements as $departement): ?>
                  <option value="<?= esc($departement['id']) ?>" <?= (($editEmploye['departement_id'] ?? '') == $departement['id']) ? 'selected' : '' ?>><?= esc($departement['nom']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="f-group">
              <label class="f-label">Rôle</label>
              <select name="role" class="f-select" required>
                <option value="employe" <?= (($editEmploye['role'] ?? '') === 'employe') ? 'selected' : '' ?>>Employé</option>
                <option value="rh" <?= (($editEmploye['role'] ?? '') === 'rh') ? 'selected' : '' ?>>Responsable RH</option>
                <option value="admin" <?= (($editEmploye['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Administrateur</option>
              </select>
            </div>
            <div class="f-group">
              <label class="f-label">Date d'embauche</label>
              <input type="date" name="date_embauche" class="f-input" value="<?= esc($editEmploye['date_embauche'] ?? date('Y-m-d')) ?>" required/>
            </div>
            <div class="f-group" style="display:flex;align-items:flex-end;gap:8px">
              <input type="checkbox" name="actif" value="1" <?= (($editEmploye['actif'] ?? 1) ? 'checked' : '') ?> style="width:18px;height:18px"/>
              <label class="f-label" style="margin:0">Compte actif</label>
            </div>
          </div>
          <div class="flash flash-info" style="margin-bottom:1rem">
            <i class="bi bi-info-circle-fill"></i>
            <span style="font-size:.82rem">Les soldes de congés seront gérés séparément par type de congé et par année.</span>
          </div>
          <div class="form-actions">
            <button class="btn-forest" type="submit"><i class="bi bi-save"></i> <?= $editEmploye ? 'Mettre à jour' : 'Créer l’employé' ?></button>
            <a class="btn-secondary" href="<?= base_url('admin/employe') ?>">Réinitialiser</a>
          </div>
        </form>
      </div>

      <div class="data-card">
        <div class="data-card-head">
          <h3>Tous les employés</h3>
        </div>
        <table class="tbl">
          <thead>
            <tr><th>Employé</th><th>Département</th><th>Rôle</th><th>Embauche</th><th>Statut</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php if (empty($employes)): ?>
              <tr><td colspan="6"><div class="empty"><i class="bi bi-people"></i><p>Aucun employé enregistré.</p></div></td></tr>
            <?php else: ?>
              <?php foreach ($employes as $employe): ?>
                <?php
                  $initials = strtoupper(substr((string) ($employe['prenom'] ?? ''), 0, 1) . substr((string) ($employe['nom'] ?? ''), 0, 1));
                  $isActive = (int) ($employe['actif'] ?? 0) === 1;
                ?>
                <tr>
                  <td>
                    <div class="profile-row">
                      <div class="avatar av-green" style="width:32px;height:32px;font-size:.68rem"><?= esc($initials ?: '??') ?></div>
                      <div class="profile-info">
                        <div class="pname"><?= esc(trim(($employe['prenom'] ?? '') . ' ' . ($employe['nom'] ?? ''))) ?></div>
                        <div class="pdept"><?= esc($employe['email'] ?? '') ?></div>
                      </div>
                    </div>
                  </td>
                  <td class="td-muted"><?= esc($employe['departement_nom'] ?? 'Sans département') ?></td>
                  <td><span class="type-badge <?= (($employe['role'] ?? '') === 'admin') ? 't-special' : ((($employe['role'] ?? '') === 'rh') ? 't-maladie' : 't-annuel') ?>"><?= esc($employe['role'] ?? '') ?></span></td>
                  <td class="td-muted td-mono" style="font-size:.78rem"><?= esc($employe['date_embauche'] ?? '') ?></td>
                  <td><span class="statut <?= $isActive ? 's-approuvee' : 's-annulee' ?>" style="font-size:.68rem"><?= $isActive ? 'actif' : 'inactif' ?></span></td>
                  <td>
                    <div class="action-btns">
                      <a class="btn-sm btn-edit" href="<?= base_url('admin/employe?edit_employe=' . $employe['id']) ?>"><i class="bi bi-pencil"></i> Éditer</a>
                      <form action="<?= base_url('admin/employe/delete/' . $employe['id']) ?>" method="post" style="display:inline">
                        <button class="btn-sm btn-del" type="submit" onclick="return confirm('Supprimer cet employé ?')"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="form-section" id="page-admin-departements">
        <h3><i class="bi bi-building" style="color:var(--forest);margin-right:6px"></i><?= $editDepartement ? 'Modifier le département' : 'Ajouter un département' ?></h3>
        <form action="<?= base_url('admin/departement/save') ?>" method="post">
          <input type="hidden" name="id" value="<?= esc($editDepartementId) ?>"/>
          <div class="form-grid-2" style="margin-bottom:1rem">
            <div class="f-group">
              <label class="f-label">Nom</label>
              <input type="text" name="nom" class="f-input" placeholder="IT" value="<?= esc($editDepartement['nom'] ?? '') ?>" required/>
            </div>
            <div class="f-group">
              <label class="f-label">Description</label>
              <input type="text" name="description" class="f-input" placeholder="Service informatique" value="<?= esc($editDepartement['description'] ?? '') ?>"/>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn-forest" type="submit"><i class="bi bi-save"></i> <?= $editDepartement ? 'Mettre à jour' : 'Créer le département' ?></button>
            <a class="btn-secondary" href="<?= base_url('admin/employe') ?>#page-admin-departements">Réinitialiser</a>
          </div>
        </form>
      </div>

      <div class="data-card">
        <div class="data-card-head"><h3>Départements</h3></div>
        <table class="tbl">
          <thead>
            <tr><th>Nom</th><th>Description</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php if (empty($departements)): ?>
              <tr><td colspan="3"><div class="empty"><i class="bi bi-building"></i><p>Aucun département enregistré.</p></div></td></tr>
            <?php else: ?>
              <?php foreach ($departements as $departement): ?>
                <tr>
                  <td class="td-name"><?= esc($departement['nom']) ?></td>
                  <td class="td-muted"><?= esc($departement['description']) ?></td>
                  <td>
                    <div class="action-btns">
                      <a class="btn-sm btn-edit" href="<?= base_url('admin/employe?edit_departement=' . $departement['id']) ?>#page-admin-departements"><i class="bi bi-pencil"></i> Éditer</a>
                      <form action="<?= base_url('admin/departement/delete/' . $departement['id']) ?>" method="post" style="display:inline">
                        <button class="btn-sm btn-del" type="submit" onclick="return confirm('Supprimer ce département ?')"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="form-section" id="page-admin-types-conge">
        <h3><i class="bi bi-tags" style="color:var(--forest);margin-right:6px"></i><?= $editTypeConge ? 'Modifier le type de congé' : 'Ajouter un type de congé' ?></h3>
        <form action="<?= base_url('admin/type-conge/save') ?>" method="post">
          <input type="hidden" name="id" value="<?= esc($editTypeCongeId) ?>"/>
          <div class="form-grid-2" style="margin-bottom:1rem">
            <div class="f-group">
              <label class="f-label">Libellé</label>
              <input type="text" name="libelle" class="f-input" placeholder="Congé annuel" value="<?= esc($editTypeConge['libelle'] ?? '') ?>" required/>
            </div>
            <div class="f-group">
              <label class="f-label">Jours annuels</label>
              <input type="number" name="jours_annuels" class="f-input" min="0" value="<?= esc($editTypeConge['jours_annuels'] ?? 0) ?>" required/>
            </div>
            <div class="f-group" style="display:flex;align-items:flex-end;gap:8px">
              <input type="checkbox" name="deductible" value="1" <?= (($editTypeConge['deductible'] ?? 0) ? 'checked' : '') ?> style="width:18px;height:18px"/>
              <label class="f-label" style="margin:0">Déductible du solde</label>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn-forest" type="submit"><i class="bi bi-save"></i> <?= $editTypeConge ? 'Mettre à jour' : 'Créer le type' ?></button>
            <a class="btn-secondary" href="<?= base_url('admin/employe') ?>#page-admin-types-conge">Réinitialiser</a>
          </div>
        </form>
      </div>

      <div class="data-card">
        <div class="data-card-head"><h3>Types de congé</h3></div>
        <table class="tbl">
          <thead>
            <tr><th>Libellé</th><th>Jours annuels</th><th>Déductible</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php if (empty($typesConge)): ?>
              <tr><td colspan="4"><div class="empty"><i class="bi bi-tags"></i><p>Aucun type de congé enregistré.</p></div></td></tr>
            <?php else: ?>
              <?php foreach ($typesConge as $typeConge): ?>
                <tr>
                  <td class="td-name"><?= esc($typeConge['libelle']) ?></td>
                  <td class="td-mono"><?= esc($typeConge['jours_annuels']) ?></td>
                  <td><span class="statut <?= ((int) $typeConge['deductible'] === 1) ? 's-approuvee' : 's-annulee' ?>"><?= ((int) $typeConge['deductible'] === 1) ? 'oui' : 'non' ?></span></td>
                  <td>
                    <div class="action-btns">
                      <a class="btn-sm btn-edit" href="<?= base_url('admin/employe?edit_type_conge=' . $typeConge['id']) ?>#page-admin-types-conge"><i class="bi bi-pencil"></i> Éditer</a>
                      <form action="<?= base_url('admin/type-conge/delete/' . $typeConge['id']) ?>" method="post" style="display:inline">
                        <button class="btn-sm btn-del" type="submit" onclick="return confirm('Supprimer ce type de congé ?')"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
    <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>
  </div>

</div>
</section>
</body>
</html>