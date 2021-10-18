-- Database: `perma`

--
-- Table structure for table `utilizatori`
-- localitate poate fi sat, comuna, sat

CREATE TABLE `utilizatori` (
                              `username` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `parola` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
                              `mail` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
                              `dataNasterii` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
                              `gen` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `tara` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `localitate` varchar(50) COLLATE utf8_romanian_ci,
                              `strada` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `judet` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `bloc` varchar(50) COLLATE utf8_romanian_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `utilizatori`
--
INSERT INTO `utilizatori` (`username`, `parola`, `mail`, `dataNasterii`, `gen`,`tara`, `localitate`, `strada` ,`judet`, `bloc`) VALUES
('dan77', 'par19', 'daniel@gmail.com', '06/10/1998', 'm', 'romania', 'iasi', 'strada1', 'iasi','1'),
('anABC','parolaabc','abc@gmail.com','06/10/2000','f','romania','iasi','strada2','iasi','1'),
('stAl','sti11','steve@gmail.com','11/08/1998','m','romania','iasi','strada11','iasi','1');


--
-- Table structure for table `produse`
-- mirospatrunzator TRUE OR FALSE
CREATE TABLE `produse` (
                              `idProdus` int(10) NOT NULL AUTO_INCREMENT,
                              `numeProdus` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `pathName` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
                              `anotimp` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
                              `destinatar` varchar(40) COLLATE utf8_romanian_ci NOT NULL,
                              `pret` float(6,2) NOT NULL,
                              `gramaj` int(10) NOT NULL,
                              `mirosPatrunzator` varchar(50) COLLATE utf8_romanian_ci,
                              `durataMiros` int(10) NOT NULL,
                              `ocazie` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                               KEY (idProdus)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `produse`
--
INSERT INTO `produse` ( `numeProdus`, `pathName`, `anotimp`, `destinatar`,`pret`, `gramaj`, `mirosPatrunzator` ,`durataMiros`, `ocazie`) VALUES
( 'parfum-lavanda', 'parfum-lavanda.jpg', 'primavara', 'f', '100', '100', 'true', '6','plimbare oras/sport'),
('parfum-pentru-barbati1','parfum-pentru-barbati1.jpg','vara','m','159','50','false','4','petrecere/aniversare'),
('parfum-pentru-barbati3','parfum-pentru-barbati3.jpg','primavara','m','359','100','false','6','lucru/aniversare'),
('parfum-pentru-barbati5','parfum-pentru-barbati5.jpg','vara','m','130','100','true','4','lucru/aniversare/sport'),
('parfum-pentru-femei1','parfum-pentru-femei1.jpg','vara','f','689','100','true','10','cumparaturi'),
('parfum-pentru-femei2','parfum-pentru-femei2.jpg','iarna','f','400','50','true','4','cumparaturi'),
('parfum-pentru-femei3','parfum-pentru-femei3.jpg','primavara','f','200','160','true','6','cumparaturi/aniversare'),
('parfum-pentru-femei4','parfum-pentru-femei4.jpg','primavara','f','279','100','true','8','cumparaturi/aniversare/petrecere'),
('parfum-pentru-femei5','parfum-pentru-femei5.jpg','iarna','f','379','100','true','8','cumparaturi/aniversare/petrecere'),
('parfum-pentru-barbati2','parfum-pentru-barbati2.jpg','all seazon','m','260','120','true','8','aniversare/absolvire');


--
-- Table structure for table `ingrediente`
CREATE TABLE `ingrediente` (
                              `numeIngredient` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
                              `idsProduse` varchar(100) COLLATE utf8_romanian_ci 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;
--
-- Dumping data for table `ingrediente`
--
INSERT INTO `ingrediente` ( `numeIngredient`, `idsProduse`) VALUES
( 'lavanda', '1/10/5/'),
('ulei esenţial de azalee','5/6/7/8/9/'),
('vanilie','6/7/9/'),
('trandafiri','5/'),
('lăcrămioare','6/8/9/'),
('lemn de guaiac','2/3/4/10/'),
('ambra','3/4/'),
('coaja grepfrup','2/10/'),
('alcool farmaceutic','3/10/');


--
-- Table structure for table `comentarii`
CREATE TABLE `comentarii` (
                              `numeUtilizator` varchar(100) COLLATE utf8_romanian_ci NOT NULL,
                              `dataComentariu` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
                              `numeProdus` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `comentariu` varchar(150) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `comentarii`
--
INSERT INTO `comentarii` (`numeUtilizator`, `dataComentariu`,`numeProdus`,`comentariu`) VALUES
( 'dan77', '09/05/2021','parfum-lavanda','Un produs bun.'),
('stAl','11/05/2021','parfum-pentru-barbati1','Imi place acest produs.Este ok.');


--
-- Table structure for table `vanzari`
CREATE TABLE `vanzari` (
                              `numeProdus` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `dataVanzare` varchar(30) COLLATE utf8_romanian_ci NOT NULL,
                              `numeUtilizator` varchar(50) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `vanzari`
--
INSERT INTO `vanzari` (`numeProdus`, `dataVanzare`,`numeUtilizator`) VALUES
( 'parfum-lavanda', '09/05/2021','dan77'),
('parfum-pentru-femei2','11/05/2021','stAl');

--
-- Table structure for table `cadouri`
CREATE TABLE `cadouri` (
                              `numeUtilizator` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `tara` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `judet` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `localitate` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `strada` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `bloc` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `etaj` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `nrStrada` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `dataCadou` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `numeProdus` varchar(50) COLLATE utf8_romanian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `cadouri`
--
INSERT INTO `cadouri` (`numeUtilizator`, `tara`,`judet`,`localitate`,`strada`,`bloc`,`etaj`,`nrStrada`,`dataCadou`,`numeProdus`) VALUES
( 'dan77', 'romania','iasi','iasi','strada11','1','2','15','08/05/2021','parfum-pentru-barbati5'),
('stAl','romania','iasi','iasi','strada10A','1','5','20','10/05/2021','parfum-pentru-femei2');


--
-- Table structure for table `inStoc`
CREATE TABLE `inStoc` (
                              `numeProdus` varchar(50) COLLATE utf8_romanian_ci NOT NULL,
                              `numar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_romanian_ci;

--
-- Dumping data for table `inStoc`
--
INSERT INTO `inStoc` (`numeProdus`, `numar`) VALUES
('parfum-lavanda','50'),
('parfum-pentru-barbati1','50'),
('parfum-pentru-barbati3','50'),
('parfum-pentru-barbati5','50'),
('parfum-pentru-femei1','50'),
('parfum-pentru-femei2','50'),
('parfum-pentru-femei3','50'),
('parfum-pentru-femei4','50'),
('parfum-pentru-femei5','50'),
('parfum-pentru-barbati2','50');




--
-- Indexes for table `utilizatori`
ALTER TABLE `utilizatori`
    ADD PRIMARY KEY (`username`);



-- Indexes for table `ingrediente`
ALTER TABLE `ingrediente`
    ADD PRIMARY KEY (`numeIngredient`);           