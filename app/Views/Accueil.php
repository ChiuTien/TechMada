<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Congés - Minitpa13h</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #0f172a;
            line-height: 1.5;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #0f172a 0%, #0a0f1c 100%);
            color: #e2e8f0;
            flex-shrink: 0;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.06);
        }

        .sidebar-header {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 24px;
        }

        .sidebar-header h2 {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: -0.2px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header h2 i {
            color: #38bdf8;
            font-size: 1.6rem;
        }

        .role-badge {
            background: #1e293b;
            padding: 5px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 500;
            display: inline-block;
            margin-top: 12px;
            color: #94a3b8;
        }

        .nav-menu {
            list-style: none;
            padding: 0 16px;
        }

        .nav-item {
            margin-bottom: 6px;
        }

        .nav-item span.nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 16px;
            border-radius: 12px;
            color: #cbd5e1;
            font-weight: 500;
            cursor: default;
        }

        .nav-item span.nav-link i {
            width: 22px;
            font-size: 1.1rem;
            text-align: center;
        }

        .nav-item span.nav-link.active {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 10px -3px #1e40af40;
        }

        .nav-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.06);
            margin: 18px 16px;
        }

        /* ========== MAIN ========== */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 14px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-weight: 500;
            color: #1e293b;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }

        .logout-placeholder {
            color: #64748b;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: default;
        }

        /* Contenu */
        .content {
            padding: 32px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.02);
            border: 1px solid #eef2f8;
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5b6e8c;
            font-weight: 600;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 8px;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 28px;
            margin-bottom: 28px;
            border: 1px solid #edf2f7;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .card-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-placeholder {
            padding: 8px 18px;
            border-radius: 40px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e2e8f0;
            color: #475569;
            cursor: default;
        }

        .btn-primary-placeholder {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-sm-placeholder {
            padding: 4px 12px;
            font-size: 0.75rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 14px 8px 12px 0;
            font-weight: 600;
            color: #475569;
            border-bottom: 1px solid #e9edf2;
        }

        td {
            padding: 14px 8px 14px 0;
            border-bottom: 1px solid #f1f4f9;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge-pending { background: #fffbeb; color: #b45309; border:1px solid #ffedd5;}
        .badge-approved { background: #e6f7ec; color: #166534; }
        .badge-refused { background: #fee9e7; color: #b91c1c; }

        .flash {
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 28px;
            font-weight: 500;
        }

        .flash-success {
            background: #e0f2e9;
            color: #0a5c36;
            border-left: 4px solid #2e7d32;
        }

        .info-note {
            background: #f0f9ff;
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 0.8rem;
            border: 1px solid #d9effa;
            margin-top: 24px;
        }

        hr {
            margin: 18px 0;
            border-color: #edf2f7;
        }

        .action-group {
            display: flex;
            gap: 8px;
        }

        .action-placeholder {
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 0.7rem;
            color: #475569;
            cursor: default;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-calendar-alt"></i> CongésFlow</h2>
            <div class="role-badge">
                <i class="fas fa-user-tie"></i> 
                <span>Ressources Humaines</span>
            </div>
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><span class="nav-link active"><i class="fas fa-tachometer-alt"></i> <span>Tableau de bord</span></span></li>
            <li class="nav-item"><span class="nav-link"><i class="fas fa-users"></i> <span>Demandes à valider</span></span></li>
            <li class="nav-item"><span class="nav-link"><i class="fas fa-chart-simple"></i> <span>Suivi soldes</span></span></li>
            <li class="nav-item"><span class="nav-link"><i class="fas fa-calendar-check"></i> <span>Calendrier</span></span></li>
            <div class="nav-divider"></div>
            <li class="nav-item"><span class="nav-link"><i class="fas fa-cog"></i> <span>Paramètres</span></span></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="topbar">
            <h1 class="page-title">Tableau de bord RH</h1>
            <div class="user-area">
                <span class="user-name">Camille Bernard</span>
                <div class="avatar">CB</div>
                <div class="logout-placeholder">
                    <i class="fas fa-arrow-right-from-bracket"></i> Déconnexion
                </div>
            </div>
        </div>

        <div class="content">
            <!-- Flash message informatif -->
            <div class="flash flash-success">
                <i class="fas fa-check-circle"></i> Système de gestion des congés · Logique métier : solde déduit uniquement à l'approbation
            </div>

            <!-- Cartes statistiques -->
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-label">Demandes en attente</div><div class="stat-number">4</div></div>
                <div class="stat-card"><div class="stat-label">Congés approuvés (mois)</div><div class="stat-number">12</div></div>
                <div class="stat-card"><div class="stat-label">Employés actifs</div><div class="stat-number">28</div></div>
                <div class="stat-card"><div class="stat-label">Solde moyen restant</div><div class="stat-number">14.5j</div></div>
            </div>

            <!-- Tableau des demandes à valider -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> Demandes en attente de validation</h3>
                    <div class="btn-placeholder"><i class="fas fa-sliders-h"></i> Filtrer</div>
                </div>
                <table>
                    <thead>
                        <tr><th>Employé</th><th>Type</th><th>Dates</th><th>Nb jours</th><th>Statut</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sophie Martin</td><td>Congés payés</td><td>15/05 - 22/05</td><td>6</td>
                            <td><span class="badge badge-pending">en_attente</span></td>
                            <td><div class="action-group"><span class="action-placeholder">Approuver</span> <span class="action-placeholder">Refuser</span></div></td>
                        </tr>
                        <tr>
                            <td>Lucas Moreau</td><td>RTT</td><td>02/06 - 04/06</td><td>3</td>
                            <td><span class="badge badge-pending">en_attente</span></td>
                            <td><div class="action-group"><span class="action-placeholder">Approuver</span> <span class="action-placeholder">Refuser</span></div></td>
                        </tr>
                        <tr>
                            <td>Emma Dubois</td><td>Sans solde</td><td>10/07 - 20/07</td><td>9</td>
                            <td><span class="badge badge-pending">en_attente</span></td>
                            <td><div class="action-group"><span class="action-placeholder">Approuver</span> <span class="action-placeholder">Refuser</span></div></td>
                        </tr>
                        <tr>
                            <td>Thomas Lefevre</td><td>Congés payés</td><td>05/09 - 12/09</td><td>7</td>
                            <td><span class="badge badge-pending">en_attente</span></td>
                            <td><div class="action-group"><span class="action-placeholder">Approuver</span> <span class="action-placeholder">Refuser</span></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bloc Logique métier & exemples -->
            <div class="card">
                <h3><i class="fas fa-chart-line"></i> Logique métier - Calcul du solde</h3>
                <p><strong>Règle fondamentale :</strong> Le solde est déduit <strong>uniquement à l'approbation</strong>, pas à la soumission. En cas de refus ou d'annulation après approbation, le solde est automatiquement recrédité.</p>
                <hr>
                <div style="background: #f8fafc; border-radius: 16px; padding: 16px; font-family: monospace; font-size: 0.8rem;">
                    <strong>Exemple SQL métier :</strong><br>
                    -- À l'approbation :<br>
                    UPDATE soldes SET jours_pris = jours_pris + 6 WHERE employee_id = 12 AND annee = 2025;<br><br>
                    -- En cas d'annulation après approbation :<br>
                    UPDATE soldes SET jours_pris = jours_pris - 6 WHERE employee_id = 12 AND annee = 2025;
                </div>
                <hr>
                <ul style="margin-left: 20px; color: #334155;">
                    <li><i class="fas fa-check-circle" style="color:#15803d;"></i> Demande #452 approuvée → mise à jour du solde (+6 jours pris)</li>
                    <li><i class="fas fa-undo-alt" style="color:#b45309;"></i> Demande #448 refusée après approbation → recrédit automatique de 3 jours</li>
                    <li><i class="fas fa-ban" style="color:#b91c1c;"></i> Demande #461 rejetée à la validation : solde insuffisant (15j demandés > 9j restants)</li>
                    <li><i class="fas fa-calendar-week"></i> Vérification chevauchement : impossible d'avoir deux demandes actives sur mêmes dates</li>
                </ul>
            </div>

            <!-- Tableau des soldes récents (exemple) -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-database"></i> Aperçu des soldes (2025)</h3>
                    <div class="btn-placeholder"><i class="fas fa-download"></i> Exporter</div>
                </div>
                <table>
                    <thead>
                        <tr><th>Employé</th><th>Congés payés (attribués)</th><th>Jours pris</th><th>Reste</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Sophie Martin</td><td>25</td><td>8</td><td>17</td><td><span class="badge badge-approved">suffisant</span></td></tr>
                        <tr><td>Lucas Moreau</td><td>25</td><td>21</td><td>4</td><td><span class="badge badge-pending">attention</span></td></tr>
                        <tr><td>Emma Dubois</td><td>25</td><td>12</td><td>13</td><td><span class="badge badge-approved">ok</span></td></tr>
                        <tr><td>Thomas Lefevre</td><td>25</td><td>5</td><td>20</td><td><span class="badge badge-approved">suffisant</span></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Note technique - sans aucun lien -->
            <div class="info-note">
                <i class="fas fa-info-circle"></i> <strong>Architecture technique :</strong> 
                - CodeIgniter 4 · Session native · password_hash() · AuthFilter sur routes protégées<br>
                - 5 tables : departements, types_conge, employes, soldes, conges<br>
                - Validation : <code>jours_pris + nb_jours_demandés ≤ jours_attribués</code> avant approbation<br>
                - Carbon / date_diff pour le calcul des jours · Query Builder uniquement · CSRF activé<br>
                - Pattern PRG (Post/Redirect/Get) + Flashdata CI4 pour messages succès/erreur
            </div>
        </div>
    </div>
</div>
</body>
</html>