-- Active: 1773730397385@@127.0.0.1@3306@TechMada
create table departements(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    nom             VARCHAR(100),
    description     VARCHAR(255)
);
create table employes(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    nom             VARCHAR(100),
    prenom          VARCHAR(100),
    email           VARCHAR(100) UNIQUE,
    password        VARCHAR(8),
    role            VARCHAR(100),
    departement_id  INT,
    date_embauche   DATE,
    actif           BOOLEAN,
    FOREIGN KEY (departement_id) REFERENCES departements(id)
);
create table types_conge(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    libelle         VARCHAR(100),
    jours_annuels   INT,
    deductible      BOOLEAN
);
create table soldes(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    employe_id      INT,
    type_conge_id   INT,
    annee           INT,
    jours_attribues INT,
    jours_pris      INT,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id)  
);
create table conges(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    employe_id      INT,
    type_conge_id   INT,
    date_debut      DATE,
    date_fin        DATE,
    nb_jours        INT,
    motif           VARCHAR(255),
    statut          VARCHAR(100),
    commentaire_rh  VARCHAR(255),
    created_at      DATE,
    traiter_par     VARCHAR(100),
    Foreign Key (employe_id) REFERENCES employes(id),
    Foreign Key (type_conge_id) REFERENCES types_conge(id)
);