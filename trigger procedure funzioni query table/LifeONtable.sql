create table Bacheche(
	IdBacheca bigint primary key AUTO_INCREMENT,
	NumeroBanner int default 0
)engine=innoDB;

create table Gruppi(
	IdGruppo bigint primary key AUTO_INCREMENT,
	Nome varchar(20) not null,
	DataCreazione date,
	IdBacheca bigint unique,
	foreign key (IdBacheca) references Bacheche(IdBacheca) on delete cascade on update cascade
)engine=innoDB;

create table Luoghi(
	CAP int primary key,
	Nome varchar(20) not null,
	Altitudine int,
	Stato varchar(20)
)engine=innoDB;

create table Scuole(
	IdScuola bigint primary key  AUTO_INCREMENT,
	Nome varchar(20) not null,
	Grado varchar(20),
	DataFondazione date,
	IdLuogo int,
	foreign key (IdLuogo) references Luoghi(CAP) on delete set null on update cascade
)engine=innoDB;

create table PostiDiLavoro(
	IdImpresa bigint primary key AUTO_INCREMENT,
	Nome varchar(20) not null,
	NomeDatore varchar(20),
	DataFondazione date,
	IdLuogo int,
	foreign key (IdLuogo) references Luoghi(CAP) on delete set null on update cascade
)engine=innoDB;

create table Persone(
	EmailUser varchar(40) primary key,
	Psw varchar(100) not null,
	Nome varchar(20) not null,
	Cognome varchar(20) not null,
	DataDiNascita date not null,
	IdScuola bigint,
	IdLavoro bigint,
	IdBacheca bigint unique,
	foreign key (IdScuola) references Scuole(IdScuola) on delete set null on update cascade,
	foreign key (IdLavoro) references PostiDiLavoro(IdImpresa) on delete set null on update cascade,
	foreign key (IdBacheca) references Bacheche(IdBacheca)on delete restrict on update cascade
)engine=innoDB;

create table Amicizie(
	IdAmico varchar(40),
	EmailUser varchar(40),
	DataAmicizia date,
	primary key(IdAmico, EmailUser),
	foreign key (IdAmico) references Persone(EmailUser) on delete cascade on update cascade,
	foreign key (EmailUser) references Persone(EmailUser) on delete cascade on update cascade
)engine=innoDB;

create table GruppiPersone(
	IdGruppo bigint,
	EmailUser varchar(40),
	foreign key (IdGruppo) references Gruppi(IdGruppo) on delete cascade on update cascade,
	foreign key (EmailUser) references Persone(EmailUser) on delete cascade on update cascade,
	primary key (IdGruppo,EmailUser)
)engine=innoDB;

create table PersoneLuoghi(
	EmailUser varchar(40),
	IdLuogo int,
	primary key (EmailUser, IdLuogo),
	foreign key (EmailUser) references Persone(EmailUser) on delete cascade on update cascade,
	foreign key (IdLuogo) references Luoghi(CAP) on delete cascade on update cascade
)engine=innoDB;

create table Post(
	IdPost bigint primary key AUTO_INCREMENT,
	DataPost date not null,
	Ora time not null,
	IdBacheca bigint,
	IdLuogo int,
	foreign key (IdLuogo) references Luoghi(CAP) on delete set null on update cascade,
	foreign key (IdBacheca) references Bacheche(IdBacheca) on delete cascade on update cascade
)engine=innoDB;

create table Stati(
	IdPost bigint primary key,
	Testo varchar(4096),
	foreign key (IdPost) references Post(IdPost) on delete cascade on update cascade
)engine=innoDB;

create table Foto(
	IdPost bigint primary key,
	Fotografia longblob,
	foreign key (IdPost) references Post(IdPost) on delete cascade on update cascade
)engine=innoDB;

create table Likes(
	EmailUser varchar(40),
	IdPost bigint,
	primary key(IdPost, EmailUser),
	foreign key (EmailUser) references Persone(EmailUser) on delete cascade on update cascade,
	foreign key (IdPost) references Post(IdPost) on delete cascade on update cascade
)engine=innoDB;


create table Error(
	error_id char(4) primary key,
	error_type varchar(50)
)engine=innoDB;

insert into Error(error_id, error_type) values
("1001","Utente minorenne ha cercato di registrarsi!"),
("1002","Password troppo corta! (almeno 8 caratteri)");