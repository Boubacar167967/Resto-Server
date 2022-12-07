USE memdb;
CREATE TABLE IF NOT EXISTS Etudiants(
  id INT(10) NOT NULL AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  numcard VARCHAR(50) NOT NULL UNIQUE,
  email varchar(50) NOT NULL UNIQUE,
  passwords varchar(50) NOT NULL,
  CONSTRAINT pk_etudiant PRIMARY KEY(id)
  );



  CREATE TABLE IF NOT EXISTS Restaurant(
  id INT(10) NOT null,
  nom varchar(100) NOT NULL,
  nb_ticket int(10) NOT null,
  resEtudiant varchar(50),
  Constraint pk_restaurant PRIMARY KEY (id)
  );