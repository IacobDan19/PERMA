<?php
//luam path.ul cum ar fi din controler....
require_once "../app/core/Model.php";
//require database
require_once "../app/core/database.php";
class admin_statistici_model extends Model {
 
    public function getNrProduse(){//array key value produs=>numar,pt toate
        $sql = "SELECT numeProdus,numar FROM inStoc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        $array=array();
        $rezultat=$cerere->fetchAll();
        foreach($rezultat as $key=>$value ){
            $array[$value['numeProdus']]=$value['numar'];
        }
        return $array;
    }

    public function getProduseArray(){//un array ce contine 2 arrayuri unul pt m,unulpt f
        $sql = "SELECT numeProdus FROM produse where destinatar LIKE '%m%'";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        $rez=$cerere->fetchAll();
        $barbati=array();
        foreach($rez as $value ){
            $barbati[$value['numeProdus']]=0;//daca nu exista il pune
        }

        $sql = "SELECT numeProdus FROM produse where destinatar LIKE '%f%'";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        $rez=$cerere->fetchAll();
        $femei=array();
        foreach($rez as $value ){
            $femei[$value['numeProdus']]=0;}


        //caut numele din ambele array
        //in tabelele cadouri si vanzari si cresc valoarea key
        //apoi soretz cu arsort() arrayul asociativ
        $sql = "SELECT numeProdus FROM cadouri";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        $cadouri=$cerere->fetchAll();
        echo '</br>';
        //print_r(array_keys($femei));
        foreach($cadouri as $val){
            if (array_key_exists($val[0],$femei)){$femei[$val[0]]=intval($femei[$val[0]]+1);}
            if (array_key_exists($val[0],$barbati)){$barbati[$val[0]]=intval($barbati[$val[0]]+1);}
        }

        $sql = "SELECT numeProdus FROM vanzari";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        $cadouri=$cerere->fetchAll();
        echo '</br>';
        //print_r(array_keys($femei));
        foreach($cadouri as $val){
            if (array_key_exists($val[0],$femei)){$femei[$val[0]]=intval($femei[$val[0]]+1);}
            if (array_key_exists($val[0],$barbati)){$barbati[$val[0]]=intval($barbati[$val[0]]+1);}
        }
       
        //acum sortam arrayurile si returnam primul element
        arsort($femei);
        arsort($barbati);
        return([array_key_first($femei),array_key_first($barbati)]);
        

        
    }
}
