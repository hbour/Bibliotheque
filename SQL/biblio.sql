/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  20/06/2011 13:39:52                      */
/*==============================================================*/


drop table if exists TJ_EMPRUNTER;

drop table if exists TJ_LIMITER_EMPRUNTS;

drop table if exists TJ_RESERVER;

drop table if exists T_ARTICLES;

drop table if exists T_CATEGORIES_USAGERS;

drop table if exists T_DISPONIBILITES;

drop table if exists T_EXEMPLAIRES;

drop table if exists T_OUVRAGES;

drop table if exists T_RELANCES;

drop table if exists T_TYPE_OUVRAGE;

drop table if exists T_USAGERS;

/*==============================================================*/
/* Table : TJ_EMPRUNTER                                         */
/*==============================================================*/
create table TJ_EMPRUNTER
(
   EXE_CODE_EXEMPLAIRE  int(4) not null,
   USA_ID               int(8) not null,
   EMP_DATE             date not null,
   EMP_EN_COURS         bool not null,
   primary key (EXE_CODE_EXEMPLAIRE, USA_ID, EMP_DATE)
);

/*==============================================================*/
/* Table : TJ_LIMITER_EMPRUNTS                                  */
/*==============================================================*/
create table TJ_LIMITER_EMPRUNTS
(
   TYP_SUPPORT          varchar(16) not null,
   CAT_CATEGORIE        varchar(16) not null,
   LIM_QUANTITE         int not null,
   LIM_DUREE            int not null,
   primary key (TYP_SUPPORT, CAT_CATEGORIE)
);

/*==============================================================*/
/* Table : TJ_RESERVER                                          */
/*==============================================================*/
create table TJ_RESERVER
(
   USA_ID               int(8) not null,
   EXE_CODE_EXEMPLAIRE  int(4) not null,
   RES_DATE             date not null,
   RES_EN_COURS         bool not null,
   primary key (USA_ID, EXE_CODE_EXEMPLAIRE, RES_DATE)
);

/*==============================================================*/
/* Table : T_ARTICLES                                           */
/*==============================================================*/
create table T_ARTICLES
(
   ART_ID               int(9) not null auto_increment,
   USA_ID               int(8) not null,
   ART_CONTENU          text not null,
   ART_TITRE            text not null,
   primary key (ART_ID)
);

/*==============================================================*/
/* Table : T_CATEGORIES_USAGERS                                 */
/*==============================================================*/
create table T_CATEGORIES_USAGERS
(
   CAT_CATEGORIE        varchar(16) not null,
   primary key (CAT_CATEGORIE)
);

/*==============================================================*/
/* Table : T_DISPONIBILITES                                     */
/*==============================================================*/
create table T_DISPONIBILITES
(
   DIS_DISPONIBILITE    varchar(16) not null,
   primary key (DIS_DISPONIBILITE)
);

/*==============================================================*/
/* Table : T_EXEMPLAIRES                                        */
/*==============================================================*/
create table T_EXEMPLAIRES
(
   EXE_CODE_EXEMPLAIRE  int(4) not null auto_increment,
   DIS_DISPONIBILITE    varchar(16) not null,
   OUV_ID               varchar(16) not null,
   primary key (EXE_CODE_EXEMPLAIRE)
);

/*==============================================================*/
/* Table : T_OUVRAGES                                           */
/*==============================================================*/
create table T_OUVRAGES
(
   OUV_ID               varchar(16) not null,
   TYP_SUPPORT          varchar(16) not null,
   OUV_AUTEUR           varchar(16) not null,
   OUV_TITRE            varchar(16) not null,
   OUV_EDITEUR          varchar(16) not null,
   OUV_COLLECTION       varchar(16),
   OUV_DATE_PARUTION    date not null,
   OUV_THEME            varchar(16) not null,
   primary key (OUV_ID)
);

/*==============================================================*/
/* Table : T_RELANCES                                           */
/*==============================================================*/
create table T_RELANCES
(
   REL_NUMERO_ID        int(8) not null auto_increment,
   USA_ID               int(8) not null,
   EXE_CODE_EXEMPLAIRE  int(4) not null,
   REL_DATE_ENVOI_EMAIL date not null,
   primary key (REL_NUMERO_ID)
);

/*==============================================================*/
/* Table : T_TYPE_OUVRAGE                                       */
/*==============================================================*/
create table T_TYPE_OUVRAGE
(
   TYP_SUPPORT          varchar(16) not null,
   primary key (TYP_SUPPORT)
);

/*==============================================================*/
/* Table : T_USAGERS                                            */
/*==============================================================*/
create table T_USAGERS
(
   USA_ID               int(8) not null auto_increment,
   CAT_CATEGORIE        varchar(16) not null,
   USA_MOTDEPASSE       varchar(16) not null,
   USA_DATE_FIN_VALIDITE date not null,
   USA_NOM              varchar(16) not null,
   USA_PRENOM           varchar(16) not null,
   USA_ADRESSE          varchar(64) not null,
   USA_TEL              varchar(16) not null,
   USA_EMAIL            varchar(16) not null,
   USA_RETARD           bool not null,
   primary key (USA_ID)
);

alter table TJ_EMPRUNTER add constraint FK_TJ_EMPRUNTER foreign key (USA_ID)
      references T_USAGERS (USA_ID) on delete restrict on update restrict;

alter table TJ_EMPRUNTER add constraint FK_TJ_EMPRUNTER2 foreign key (EXE_CODE_EXEMPLAIRE)
      references T_EXEMPLAIRES (EXE_CODE_EXEMPLAIRE) on delete restrict on update restrict;

alter table TJ_LIMITER_EMPRUNTS add constraint FK_TJ_LIMITER_EMPRUNTS foreign key (TYP_SUPPORT)
      references T_TYPE_OUVRAGE (TYP_SUPPORT) on delete restrict on update restrict;

alter table TJ_LIMITER_EMPRUNTS add constraint FK_TJ_LIMITER_EMPRUNTS2 foreign key (CAT_CATEGORIE)
      references T_CATEGORIES_USAGERS (CAT_CATEGORIE) on delete restrict on update restrict;

alter table TJ_RESERVER add constraint FK_TJ_RESERVER foreign key (USA_ID)
      references T_USAGERS (USA_ID) on delete restrict on update restrict;

alter table TJ_RESERVER add constraint FK_TJ_RESERVER2 foreign key (EXE_CODE_EXEMPLAIRE)
      references T_EXEMPLAIRES (EXE_CODE_EXEMPLAIRE) on delete restrict on update restrict;

alter table T_ARTICLES add constraint FK_TJ_REDIGER foreign key (USA_ID)
      references T_USAGERS (USA_ID) on delete restrict on update restrict;

alter table T_EXEMPLAIRES add constraint FK_TJ_CARACTERISER foreign key (DIS_DISPONIBILITE)
      references T_DISPONIBILITES (DIS_DISPONIBILITE) on delete restrict on update restrict;

alter table T_EXEMPLAIRES add constraint FK_TJ_CORRESPONDRE foreign key (OUV_ID)
      references T_OUVRAGES (OUV_ID) on delete restrict on update restrict;

alter table T_OUVRAGES add constraint FK_TYPER foreign key (TYP_SUPPORT)
      references T_TYPE_OUVRAGE (TYP_SUPPORT) on delete restrict on update restrict;

alter table T_RELANCES add constraint FK_TJ_AVERTIR foreign key (USA_ID)
      references T_USAGERS (USA_ID) on delete restrict on update restrict;

alter table T_RELANCES add constraint FK_TJ_MANQUER foreign key (EXE_CODE_EXEMPLAIRE)
      references T_EXEMPLAIRES (EXE_CODE_EXEMPLAIRE) on delete restrict on update restrict;

alter table T_USAGERS add constraint FK_GROUPER foreign key (CAT_CATEGORIE)
      references T_CATEGORIES_USAGERS (CAT_CATEGORIE) on delete restrict on update restrict;

