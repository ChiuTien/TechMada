<?php 
$Conges = $Conges ?? [];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="<?= base_url('css/project.css') ?>" rel="stylesheet"/>

<section id="page-mes-conges" style="margin-top:3rem">
<div class="app-wrap">

<!-- SIDEBAR DE L'EMPLOYE -->
   <?php include(__DIR__ . '/sidebar.php') ?>
  
  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Mes demandes de congé</div>
        <div class="topbar-breadcrumb"><a href="#page-dashboard-employe">Accueil</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Mes demandes</div>
      </div>
      <div class="topbar-actions">
        <a href="<?= base_url('employe/create') ?>" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-plus-lg"></i> Nouvelle demande</a>
      </div>
    </div>

    <div class="content">
      <div class="data-card">
        <div class="data-card-head">
          <h3>Toutes mes demandes</h3>
          <div style="display:flex;gap:6px">
            <select class="f-select" style="font-size:.8rem;padding:6px 10px;width:auto">
              <option>Tous les statuts</option>
              <option>En attente</option>
              <option>Approuvée</option>
              <option>Refusée</option>
              <option>Annulée</option>
            </select>
          </div>
        </div>
        <table class="tbl">
          <thead>
            <tr><th>Type</th><th>Début</th><th>Fin</th><th>Durée</th><th>Statut</th><th>Commentaire RH</th><th>Action</th></tr>
          </thead>
          <tbody>
            <?php foreach ($Conges as $cg) { ?>
              <tr>
                <td><span class="type-badge t-annuel"><?= esc($cg['type_conge_id']) ?></td>
                <td class="td-muted"><?= esc($cg['date_debut']) ?></td>
                <td class="td-muted"><?= esc($cg['date_fin'])?></td>
                <td class="td-mono"><?= esc($cg['nb_jours'])?></td>
                <td><span class="statut s-attente"><?= esc($cg['statut']) ?></span></td>
                <td class="td-muted" style="font-size:.78rem">—</td>
                <td><button class="btn-sm btn-cancel"><i class="bi bi-x"></i> Annuler</button></td>
              </tr>
            <?php } ?>
            
          </tbody>
        </table>
      </div>
    </div>
    <?php 
    view('includes/footer');
    ?>
  </div>

</div>
</section>