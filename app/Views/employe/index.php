<?php 
$Conges = $Conges ?? [];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="<?= base_url('css/project.css') ?>" rel="stylesheet"/>

<section id="page-mes-conges" style="margin-top:3rem">
<div class="app-wrap">

  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
      <div class="sidebar-brand-name">TechMada RH<span>Espace employé</span></div>
    </div>
    <ul class="sidebar-nav" style="margin-top:1rem">
      <li><a href="<?= base_url('employe/dashboard') ?>"><i class="bi bi-grid-1x2"></i> Tableau de bord</a></li>
      <li><a href="<?= base_url('employe/create') ?>"><i class="bi bi-plus-circle"></i> Nouvelle demande</a></li>
      <li><a href="<?= base_url('employe/index') ?>" class="active"><i class="bi bi-calendar3"></i> Mes demandes</a></li>
      <li><a href="#page-profil-employe"><i class="bi bi-person"></i> Mon profil</a></li>
    </ul>
    <div class="sidebar-user">
      <div class="s-user-row">
        <div class="avatar av-green">SR</div>
        <div><div class="user-name">Soa Rakoto</div><div class="user-role">Employé · IT</div></div>
      </div>
    </div>
  </aside>

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
            <!-- <tr>
              <td><span class="type-badge t-annuel">Annuel</span></td>
              <td class="td-muted">23 juin 2025</td>
              <td class="td-muted">27 juin 2025</td>
              <td class="td-mono">5 j</td>
              <td><span class="statut s-attente">en attente</span></td>
              <td class="td-muted" style="font-size:.78rem">—</td>
              <td><button class="btn-sm btn-cancel"><i class="bi bi-x"></i> Annuler</button></td>
            </tr> -->
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