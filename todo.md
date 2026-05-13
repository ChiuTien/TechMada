## Création de la base de données (Chiu Tien) 
    - [x] employes 
        - id 
        - nom 
        - email 
        - password 
        - role 
        - departement_id 
        - date_embauche 
        - actif 
    
    - [x] departments 
        - id 
        - nom 
        - description 

    - [x] types_conge 
        - id 
        - libelle 
        - jours_annuels 
        - deductible 

    - [x] soldes 
        - id 
        - employe_id 
        - type_conge_id 
        - annee 
        - jours_attendus 
        - jours_pris 
        - restant 
        - pris
    
    - [x] conges 
        - id 
        - employe_id 
        - type_conge_id 
        - date_debut 
        - date_fin 
        - nb_jours 
        - motif 
        - statut 
        - commentaire_rh 
        - created_at 
        - traite_par 

## Fonctionnalités par rôles 

## Employe 
    - [] Connexion / deconnexion )
    - [] Soumettre une demande de conge 
    - [] Consulter ses propres demandes et leurs status 
    - [] Voir son solde de conge restant par type 

## RH 
    - [] Toutes les demandes en attente 
    - [] Approuver ou refuser une demande 
    - [] MAJ automatique du solde à l'approbation 

## Admin 
    - [] CRUD employe 
    - [] CRUD departement et types de conge 