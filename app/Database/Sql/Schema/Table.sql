-- Active: 1778662518823@@127.0.0.1@3306
-- Converted for SQLite
PRAGMA foreign_keys = ON;

CREATE TABLE departements(
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    nom         TEXT,
    description TEXT
);

CREATE TABLE employes(
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    nom             TEXT,
    prenom          TEXT,
    email           TEXT UNIQUE,
    password        TEXT,
    role            TEXT,
    departement_id  INTEGER,
    date_embauche   TEXT,
    actif           INTEGER,
    FOREIGN KEY (departement_id) REFERENCES departements(id)
);

CREATE TABLE types_conge(
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle         TEXT,
    jours_annuels   INTEGER,
    deductible      INTEGER
);

CREATE TABLE soldes(
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id      INTEGER,
    type_conge_id   INTEGER,
    annee           INTEGER,
    jours_attribues INTEGER,
    jours_pris      INTEGER,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id)
);

CREATE TABLE conges(
    id              INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id      INTEGER,
    type_conge_id   INTEGER,
    date_debut      TEXT,
    date_fin        TEXT,
    nb_jours        INTEGER,
    motif           TEXT,
    statut          TEXT,
    commentaire_rh  TEXT,
    created_at      TEXT,
    traiter_par     TEXT,
    FOREIGN KEY (employe_id) REFERENCES employes(id),
    FOREIGN KEY (type_conge_id) REFERENCES types_conge(id)
);