create database ProjectBase_WFS205 ;
use ProjectBase_WFS205 ;

create table JustifierAbsence (
idAbsence INT PRIMARY KEY AUTO_INCREMENT,
Justifier VARCHAR(45),
motif VARCHAR(45) 
);

alter table JustifierAbsence
add constraint fk_JustifierAbsence_absence foreign key (idAbsence) references absence(idAbsence)
on update cascade on delete cascade ;

create table absence (
idAbsence INT(11) PRIMARY KEY AUTO_INCREMENT,
dateAbsence DATE ,
heureAbsence TIME , 
moduleAbsence VARCHAR(45),
formateurAbsence VARCHAR(45),
type VARCHAR(45),

filiere_idFiliere INT(11),
groupe_idGroupe INT(11),
idStagiaire INT
);



alter table absence
add constraint fk_absence_filiere foreign key (filiere_idFiliere) references filiere(idFiliere)
on update cascade on delete cascade ;



alter table absence
add constraint fk_absence_groupe foreign key (groupe_idGroupe) references groupe(idGroupe)
on update cascade on delete cascade ;

alter table absence
add constraint fk_absence_stagiaire foreign key (idStagiaire) references stagiaire(idStagiaire)
on update cascade on delete cascade ;








create table filiere (
idFiliere INT(11) PRIMARY KEY AUTO_INCREMENT,
nomFiliere VARCHAR(45) 


);



create table groupe (
idGroupe INT(11) PRIMARY KEY AUTO_INCREMENT,
nomGroupe VARCHAR(45) ,
filiere_idFiliere INT(11)
);
alter table groupe
add column annee date after nomGroupe;

alter table groupe
modify column annee varchar(50);

alter table groupe 
add column anneeScolaire varchar(50) after annee;

alter table groupe
add constraint fk_groupe_filiere foreign key (filiere_idFiliere) references filiere(idFiliere)
on update cascade on delete cascade ;

create table stagiaire (
idStagiaire INT(11) PRIMARY KEY AUTO_INCREMENT,
nomStagiaire VARCHAR(45) ,
prenomStagiaire VARCHAR(45) ,
groupe_idGroupe INT(11)
);
alter table stagiaire
add column note float after prenomStagiaire;
alter table stagiaire
add constraint fk_stagiaire_groupe foreign key (groupe_idGroupe) references groupe(idGroupe)
on update cascade on delete cascade ;

create table compte (
user INT PRIMARY KEY ,
password VARCHAR(45),
compteType varchar(20) NOT NULL,
foreign key (user) references stagiaire(idStagiaire)
);


