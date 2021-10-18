<?php
    class BD{
        private static $conexiune_bd = NULL;
        public static function obtine_conexiune(){
            if (is_null(self::$conexiune_bd))
            {
                self:: $conexiune_bd = new PDO('mysql:host=localhost;dbname=perma','root','');
            }
            return self::$conexiune_bd;
        }
    }
//BD::obtine_conexiune();  
   