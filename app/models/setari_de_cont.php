<?php
//luam path.ul cum ar fi din controler....
require_once "../app/core/Model.php";
require_once "../app/core/database.php";
//require database
class setari_de_cont_model extends Model {
 
    public function pass_credentials($uname,$parola)
    {   //prevenire sql injection
        $sql = "SELECT username FROM utilizatori where parola = :parola AND username= :username";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'parola' =>$parola,
            'username' =>$uname
        ]);
        return $cerere->fetchAll();
        //daca e diferit de null
    }
    
    public function schimba_parola($uname,$newpass)
    {
        $sql = "UPDATE utilizatori SET  parola = :parola where username = :username";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'parola' =>$newpass,
            'username' =>$uname
        ]);
        //print_r($cerere->fetchAll());
    }

    public function schimba_mail($uname,$newmail){
        $sql = "UPDATE utilizatori SET  mail = :mail where username = :username";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'mail' =>$newmail,
            'username' =>$uname
        ]);

    }
    
    
}