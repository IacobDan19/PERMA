<?php
//luam path.ul cum ar fi din controler....
require_once "../app/core/Model.php";
require_once "../app/core/database.php";
//require database
class viz_login_produs_model extends Model {

    function countComm($numeProd){
    $sql = "SELECT numeUtilizator,dataComentariu,comentariu FROM comentarii where numeProdus =:numeProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeProdus'=>$numeProd
        ]);
        return $cerere->fetchAll();
    }

    function addCom($com,$numeUtil,$numeProd){
        $sql ="INSERT INTO comentarii(numeUtilizator,dataComentariu,numeProdus,comentariu) VALUES(:numeUtilizator,:dataComentariu,:numeProdus,:comentariu)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeUtilizator'=>$numeUtil,
            'dataComentariu'=>date("d").'/'.date("m").'/'.date("Y"),
            'numeProdus'=>$numeProd,
            'comentariu'=>$com
        ]);
    }

    function getIngred($numeProd){
        $sql = "SELECT idProdus FROM produse where numeProdus =:numeProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeProdus'=>$numeProd
        ]);
        $id =$cerere->fetchAll()[0]['idProdus'];//este string

        $sql = "SELECT numeIngredient FROM ingrediente WHERE idsProduse LIKE '%$id/%'";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        return $cerere->fetchAll();
    }

    function cautaSimilare($ingredient){//pt un ingredient ret produsele ce il contin
        $sql = "SELECT idsProduse FROM ingrediente where numeIngredient =:numeIngredient";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeIngredient'=>$ingredient
        ]);
        return $cerere->fetchAll()[0]['idsProduse'];

    }

    function produsDupaId($id){
        $sql = "SELECT pathName FROM produse where idProdus =:idProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'idProdus'=>$id
        ]);
        return $cerere->fetchAll()[0]['pathName'];
    }
 
    
}