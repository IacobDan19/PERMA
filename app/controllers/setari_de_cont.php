<?php  
require_once "../app/models/setari_de_cont.php";
class setari_de_cont extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('setari_de_cont');
        $user->name = $name;
        $this->view('setari_de_cont/setari_de_cont_layout', ['name' => $user->name]);
    }

    public function modifica($caracter)
    {
        if(strlen($_POST[$caracter])==0)
        {
        echo '<style>';
        echo '#'.$caracter;
        echo'{';
        echo                'margin-bottom: 0.5rem;';
        echo                'color: green;';
        echo                'border: 4.5px solid red;';
        echo                'border-radius: 25px;';
        echo                'height: 2rem;';
         echo     '}';
        echo '</style>';
        }
    }
     

    public function change_pass()
    {
        if (isset($_POST['modpar'])){
            $nume = $_POST['uname1'];
            $pass = $_POST['parola_actuala'];
            $newpass = $_POST['parola_noua'];
            $mar = new setari_de_cont_model();
            $usname= $mar->pass_credentials($nume,$pass);
            if (count($usname)>0){
                //print($usname[0]['username']);
                $mar->schimba_parola($nume,$newpass );
                //credentialele corespund
                echo '<p id="parola_schimbata">'.$usname[0]['username'].
                ' parola ta este schimbata</p>';
                ?>
                <style>
                #parola_schimbata {
                display: flex;
                justify-content:center;
                color: 33FFE6;
                font-size: 1.5rem;
                border-radius: 25px;
                padding: 0.5rem;
                background-color: rgba(63, 7, 136, 0.562); 
                }
            </style>
       <?php }   
            else{
                $this->modifica("uname1");
                $this->modifica("parola_actuala");
                $this->modifica("parola_noua");
            }    
        }
    }

    public function change_email()
    {   
        if (isset($_POST['modemail'])){
            $nume = $_POST['uname2'];
            $pas = $_POST['parola'];
            $newemail = $_POST['email_nou'];
            $mar = new setari_de_cont_model();
            $usname= $mar->pass_credentials($nume,$pas);
            if (count($usname)>0){
                $mar->schimba_mail($nume,$newemail);
                echo '<p id="email_schimbat">'.$usname[0]['username'].
                ' mail-ul tau a fost schimbat</p>';
                ?>
                <style>
                #email_schimbat {
                display: flex;
                justify-content:center;
                color: 33FFE6;
                font-size: 1.5rem;
                border-radius: 25px;
                padding: 0.5rem;
                background-color: rgba(63, 7, 136, 0.562); 
                }
                </style>
                <?php

            }else{
                    $this->modifica("uname2");
                    $this->modifica("parola");
                    $this->modifica("email_nou");       
            }
        }
        
    }
     

    
}
$set = new setari_de_cont();
$set->change_pass();
$set->change_email();
?>


