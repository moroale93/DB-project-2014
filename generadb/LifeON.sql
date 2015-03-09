drop table if exists Error;
drop table if exists Likes;
drop table if exists Foto;
drop table if exists Stati;
drop table if exists Post;
drop table if exists PersoneLuoghi;
drop table if exists GruppiPersone;
drop table if exists Amicizie;
drop table if exists Persone;
drop table if exists PostiDiLavoro;
drop table if exists Scuole;
drop table if exists Luoghi;
drop table if exists Gruppi;
drop table if exists Bacheche;
drop function if exists num_amici;
drop function if exists num_post;
drop procedure if exists Registra_Persona;
drop procedure if exists Posta_Foto;
drop procedure if exists Posta_Stato;
drop procedure if exists Crea_Gruppo;
drop procedure if exists Iscrizione_Gruppo;
drop procedure if exists Richiedi_Amicizia;
drop procedure if exists Accetta_Amicizia;
drop procedure if exists Like_Post;
drop procedure if exists Visita_Luogo;
drop procedure if exists Posta_Foto_Su_Gruppo;
drop procedure if exists Posta_Stato_Su_Gruppo;
drop procedure if exists Studia_Presso;
drop procedure if exists lavora_Presso;
drop procedure if exists Disiscrizione_Gruppo;
drop procedure if exists Rimuovi_Amicizia;
drop procedure if exists Rimuovi_Account;
drop trigger if exists controllo_eta_e_password;
drop trigger if exists rimozione_dati_gruppo_se_vuoto;
drop trigger if exists add_banner;


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

delimiter $
create function num_amici(persona varchar(40)) returns INTEGER
BEGIN
	declare ret integer;
	select count(*) into ret from amicizie where (EmailUser=persona OR idAmico=persona) and DataAmicizia is not null;
	return ret;
END $
delimiter ;


delimiter $
create function num_post(persona varchar(40)) returns INTEGER
BEGIN
	declare ret integer;
	declare bacheca BIGINT;
	select max(IdBacheca) into bacheca from Persone where EmailUser=persona;
	select count(*) into ret from Post where IdBacheca=bacheca;
	return ret;
END $
delimiter ;


delimiter $
create procedure Registra_Persona (IN Email varchar(40), pass varchar(100), Nome varchar(20), Cognome varchar(20), DataNascita date)
BEGIN
	declare maxIdBac BIGINT;
	insert into Bacheche(NumeroBanner) values(0);
	select max(IdBacheca) INTO maxIdBac from Bacheche;
	insert into Persone(EmailUser,Psw,Nome,Cognome,DataDiNascita,IdBacheca)
	values(Email,pass,Nome,Cognome,DataNascita,maxIdBac);
END $
delimiter ;


delimiter $
create procedure Posta_Foto (IN Email varchar(40), foto longblob,CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare maxIdPost BIGINT;
	declare idBach BIGINT;
	declare esisteLuogo integer;
	select max(IdBacheca) into idBach from Persone where EmailUser=Email;
	if CAPLuogo<>0 then
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato)
		values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into Post(DataPost,Ora,IdBacheca,IdLuogo)
	values(CURDATE(),CURTIME(),idBach,CAPLuogo);
	ELSE
insert into Post(DataPost,Ora,IdBacheca)
	values(CURDATE(),CURTIME(),idBach);
end if;
	select max(IdPost) into maxIdPost from Post;
	insert into Foto(IdPost, Fotografia)
	values (maxIdPost, foto);
END $
delimiter ;


delimiter $
create procedure Posta_Stato (IN Email varchar(40), stato varchar(4096),CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare maxIdPost BIGINT;
	declare idBach BIGINT;
	declare esisteLuogo integer;
	select max(IdBacheca) into idBach from Persone where EmailUser=Email;
	if CAPLuogo<>0 then
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato)
		values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into Post(DataPost,Ora,IdBacheca,IdLuogo)
	values(CURDATE(),CURTIME(),idBach,CAPLuogo);
ELSE
insert into Post(DataPost,Ora,IdBacheca)
	values(CURDATE(),CURTIME(),idBach);
end if;

	select max(IdPost) into maxIdPost from Post;
	insert into Stati(IdPost, Testo)
	values (maxIdPost, stato);
END $
delimiter ;


delimiter $
create procedure Crea_Gruppo(NomeGruppo varchar(20))
BEGIN
	declare maxIdBac BIGINT;
	insert into Bacheche(NumeroBanner) values(0);
	select max(IdBacheca) INTO maxIdBac from Bacheche;
	insert into Gruppi(Nome,DataCreazione,IdBacheca)
	values(NomeGruppo, CURDATE(), maxIdBac);
END $
delimiter ;


delimiter $
create procedure Iscrizione_Gruppo(email varchar(40), idGroup BIGINT)
BEGIN
	insert into GruppiPersone(EmailUser,IdGruppo)
	values(email, IdGroup);
END $
delimiter ;


delimiter $
create procedure Richiedi_Amicizia(emailMittente varchar(40), emailDestinatario varchar(40))
BEGIN
	insert into Amicizie(EmailUser,IdAmico)
	values(emailMittente, emailDestinatario);
END $
delimiter ;


delimiter $
create procedure Accetta_Amicizia(emailAccettante varchar(40), emailDestinatario varchar(40))
BEGIN
	declare esiste_richiesta INTEGER;
	select Count(*) into esiste_richiesta from Amicizie where IdAmico=emailAccettante AND EmailUser=emailDestinatario AND DataAmicizia is null;
	IF esiste_richiesta=1 THEN
		update Amicizie set dataAmicizia=CURDATE() where IdAmico=emailAccettante AND EmailUser=emailDestinatario;
	END IF;
END $
delimiter ;


delimiter $
create procedure Like_Post(id_post BIGINT, emailLiker varchar(40))
BEGIN
	insert into Likes(EmailUser,IdPost)
	values(emailLiker, id_post);
END $
delimiter ;


delimiter $
create procedure Visita_Luogo (IN Email varchar(40), CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare esisteLuogo integer;
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato)
		values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into PersoneLuoghi(EmailUser,IdLuogo)
	values(Email, CAPLuogo);
END $
delimiter ;

delimiter $
create procedure Posta_Foto_Su_Gruppo (gruppo BIGINT, foto longblob,CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare maxIdPost BIGINT;
	declare idBach BIGINT;
	declare esisteLuogo integer;
	select max(IdBacheca) into idBach from Gruppi where IdGruppo=gruppo;
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if CAPLuogo<>0 then
		select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato)
		values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into Post(DataPost,Ora,IdBacheca,IdLuogo)
	values(CURDATE(),CURTIME(),idBach,CAPLuogo);
	else
		insert into Post(DataPost,Ora,IdBacheca)
		values(CURDATE(),CURTIME(),idBach);
	end if;
	select max(IdPost) into maxIdPost from Post;
	insert into Foto(IdPost, Fotografia)
	values (maxIdPost, foto);
END $
delimiter ;

delimiter $
create procedure Posta_Stato_Su_Gruppo (gruppo BIGINT, stato varchar(4096),CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare maxIdPost BIGINT;
	declare idBach BIGINT;
	declare esisteLuogo integer;
	select max(IdBacheca) into idBach from Gruppi where IdGruppo=gruppo;
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if CAPLuogo<>0 then
		select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato)
		values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into Post(DataPost,Ora,idBacheca,IdLuogo)
	values(CURDATE(),CURTIME(),idBach,CAPLuogo);
	else
		insert into Post(DataPost,Ora,IdBacheca)
		values(CURDATE(),CURTIME(),idBach);
	end if;
	select max(IdPost) into maxIdPost from Post;
	insert into Stati(IdPost, Testo)
	values (maxIdPost, stato);
END $
delimiter ;


delimiter $
create procedure Studia_Presso (IN Email varchar(40), nomeScuola varchar(20),GradoScuola varchar(20),dataFondazioneScuola date,CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare esisteScuola integer;
	declare esisteLuogo integer;
	declare idSc bigint;
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into luoghi(CAP, Nome, Altitudine, Stato)
values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
	insert into Scuole(Nome, Grado, DataFondazione,IdLuogo)
		values (nomeScuola, GradoScuola, dataFondazioneScuola, CAPLuogo);
		select max(IdScuola) into idSc from Scuole;
	update Persone set IdScuola=idSc where EmailUser=Email;
END $
delimiter ;


delimiter $
create procedure Lavora_Presso (IN Email varchar(40), nomeImp varchar(20),nomeDatoreLavoro varchar(20),dataFondazioneImp date,CAPLuogo integer,NomeLuogo varchar(20),altitudineLuogo integer,StatoLuogo varchar(20))
BEGIN
	declare esistePostoLav integer;
	declare esisteLuogo integer;
	declare idLa bigint;
	select count(CAP) into esisteLuogo from Luoghi where CAP=CAPLuogo;
	if(esisteLuogo=0)then
		insert into Luoghi(CAP, Nome, Altitudine, Stato) values(CAPLuogo,NomeLuogo,altitudineLuogo,StatoLuogo);
	end if;
		insert into PostiDiLavoro(Nome, NomeDatore, DataFondazione,IdLuogo)
		values (nomeImp, nomeDatoreLavoro, dataFondazioneImp, CAPLuogo);
		select max(IdImpresa) into idLa from PostiDiLavoro;	update Persone set IdLavoro=idLa where EmailUser=Email;
END $
delimiter ;


delimiter $
create procedure Disiscrizione_Gruppo(email varchar(40), idGroup BIGINT)
BEGIN
	delete from GruppiPersone
	where EmailUser=email AND IdGruppo=idGroup;
END $
delimiter ;


delimiter $
create procedure Rimuovi_Amicizia(emailMittente varchar(40), emailDestinatario varchar(40))
BEGIN
	delete from Amicizie
	where (EmailUser=emailMittente AND IdAmico=emailDestinatario) OR (IdAmico=emailMittente AND EmailUser=emailDestinatario) and DataAmicizia is not null;
END $
delimiter ;


delimiter $
create procedure Rimuovi_Account(email varchar(40))
BEGIN
	declare idbac BIGINT;
	select max(IdBacheca) into idbac from Persone where EmailUser=email;
	delete from Persone
	where EmailUser=email;
	delete from Bacheche
	where IdBacheca=idbac;
END $
delimiter ;

delimiter $
create trigger controllo_eta_e_password
BEFORE INSERT ON Persone
FOR EACH ROW
BEGIN
	IF (DATEDIFF(NOW(),NEW.DataDiNascita)<6570) THEN
		insert into Error(error_id, error_type)
		values ("1001","Utente minorenne ha cercato di registrarsi!");
	END IF;
END $
delimiter ;

delimiter $
create trigger rimozione_dati_gruppo_se_vuoto
AFTER DELETE ON GruppiPersone
FOR EACH ROW
BEGIN
	declare id_gruppo_da_cancellare BIGINT default 0;
    declare idBacDaSvuotare BIGINT default 0;
	SELECT IdGruppo INTO id_gruppo_da_cancellare From GruppiPersone group by IdGruppo HAVING count(*)=0;
	IF id_gruppo_da_cancellare =0 THEN        
		SELECT IdBacheca INTO idBacDaSvuotare FROM Gruppi WHERE IdGruppo=id_gruppo_da_cancellare;
		DELETE FROM Bacheche WHERE IdBacheca=idBacDaSvuotare;
	END IF;
END $
delimiter ;

delimiter $
create trigger add_banner
AFTER UPDATE ON Amicizie
FOR EACH ROW
BEGIN
	DECLARE numAmiciA INTEGER default 0;
	DECLARE numAmiciB INTEGER default 0;
	DECLARE AmicoA varchar(40) default 0;
	DECLARE AmicoB varchar(40) default 0;
	DECLARE IdBachecaAmicoA INTEGER default 0;
	DECLARE IdBachecaAmicoB INTEGER default 0;
	DECLARE BannerAmicoA INTEGER;
	DECLARE BannerAmicoB INTEGER;
	SET AmicoA=new.EmailUser;
	SET AmicoB=new.idAmico;
	SELECT count(*) INTO numAmiciA FROM Amicizie WHERE (EmailUser=AmicoA OR IdAmico=AmicoA) AND DataAmicizia IS NOT NULL;
	SELECT count(*) INTO numAmiciB FROM Amicizie WHERE (EmailUser=AmicoB OR IdAmico=AmicoB) AND DataAmicizia IS NOT NULL;
	SELECT max(IdBacheca) INTO IdBachecaAmicoA FROM Persone WHERE EmailUser=AmicoA;
	SELECT max(IdBacheca) INTO IdBachecaAmicoB FROM Persone WHERE EmailUser=AmicoB;
	SELECT max(NumeroBanner) INTO BannerAmicoA FROM Bacheche WHERE IdBacheca=IdBachecaAmicoA;
	SELECT max(NumeroBanner) INTO BannerAmicoB FROM Bacheche WHERE IdBacheca=IdBachecaAmicoB;
	
	IF numAmiciA>0 AND numAmiciA<10 THEN IF BannerAmicoA <> 1 THEN UPDATE Bacheche SET numeroBanner=1 WHERE idBacheca=IdBachecaAmicoA; END IF;
		else IF numAmiciA>9 AND numAmiciA<30 THEN IF BannerAmicoA <> 2 THEN UPDATE Bacheche SET numeroBanner=2 WHERE idBacheca=IdBachecaAmicoA; END IF;
			else IF numAmiciA>29 AND numAmiciA<150 THEN IF BannerAmicoA <> 3 THEN UPDATE Bacheche SET numeroBanner=3 WHERE idBacheca=IdBachecaAmicoA; END IF;
				else IF numAmiciA>149 AND numAmiciA<500 THEN IF BannerAmicoA <> 4 THEN UPDATE Bacheche SET numeroBanner=4 WHERE idBacheca=IdBachecaAmicoA; END IF;
					else IF numAmiciA>499 AND numAmiciA<1000 THEN IF BannerAmicoA <> 5 THEN UPDATE Bacheche SET numeroBanner=5 WHERE idBacheca=IdBachecaAmicoA; END IF;
						else IF numAmiciA>999 THEN IF BannerAmicoA <> 6 THEN UPDATE Bacheche SET numeroBanner=6 WHERE idBacheca=IdBachecaAmicoA; END IF;
						END IF;
					END IF;
				END IF;
			END IF;
		END IF;
	END IF;
	
	IF numAmiciB>0 AND numAmiciB<10 THEN IF BannerAmicoB <> 1 THEN UPDATE Bacheche SET numeroBanner=1 WHERE idBacheca=IdBachecaAmicoB; END IF;
	else IF numAmiciB>9 AND numAmiciB<30 THEN IF BannerAmicoB <> 2 THEN UPDATE Bacheche SET numeroBanner=2 WHERE idBacheca=IdBachecaAmicoB; END IF;
			else IF numAmiciB>29 AND numAmiciB<150 THEN IF BannerAmicoB <> 3 THEN UPDATE Bacheche SET numeroBanner=3 WHERE idBacheca=IdBachecaAmicoB; END IF;
				else IF numAmiciB>149 AND numAmiciB<500 THEN IF BannerAmicoB <> 4 THEN UPDATE Bacheche SET numeroBanner=4 WHERE idBacheca=IdBachecaAmicoB; END IF;
					else IF numAmiciB>499 AND numAmiciB<1000 THEN IF BannerAmicoB <> 5 THEN UPDATE Bacheche SET numeroBanner=5 WHERE idBacheca=IdBachecaAmicoB; END IF;
						else IF numAmiciB>999 THEN IF BannerAmicoB <> 6 THEN UPDATE Bacheche SET numeroBanner=6 WHERE idBacheca=IdBachecaAmicoB; END IF;
						END IF;
					END IF;
				END IF;
			END IF;
		END IF;
	END IF;
END $
delimiter ;

