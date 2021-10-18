<?php  
require_once "../app/models/viz_login_produs.php";
require_once "../app/models/cos_cumparaturi.php";
require_once "../app/views/viz_login_produs/viz_login_produs_layout.php";
//stiu ca numele de clasa incep cu litera mare dar am gresit
class viz_login_produs extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('viz_login_produs');
        $user->name = $name;
        $this->view('viz_login_produs/viz_login_produs_layout', ['name' => $user->name]);
    }

    public function afisCom() {
        $produsDeVazut= $_SESSION['produsDeVazut'];
        $loginViz = new viz_login_produs_model();
        $numarCom = count($loginViz->countComm($produsDeVazut));
        $detaliiCom=$loginViz->countComm($produsDeVazut);
        //print_r($detaliiCom);
        //echo gettype($detaliiCom[0]["comentariu"]);
        for($i=0;$i<$numarCom;$i++){
        echo '<script type="text/JavaScript">
        addCom();
        function addCom(){
            let chat = document.getElementById(\'chat\');
            let div = document.createElement(\'div\');
            chat.appendChild(div);
            let ul = document.createElement("ul");
            div.appendChild(ul);
            let liCom = document.createElement("li");
            liCom.id=\'com\'+'.strval($i+1).'
            
            //prevenire cross site scripting
            liCom.innerHTML = \''. htmlspecialchars($detaliiCom[$i]["comentariu"]).'\'
            let liUtil = document.createElement("li");
            liUtil.id=\'util\'+'.strval($i+1).'
            liUtil.innerHTML = \''.$detaliiCom[$i]["numeUtilizator"].'\'
            let liData = document.createElement("li");
            liData.id=\'data\'+'.strval($i+1).'
            liData.innerHTML = \''.$detaliiCom[$i]["dataComentariu"].'\'
            ul.appendChild(liCom);
            ul.appendChild(liUtil);
            ul.appendChild(liData); 
        }
        </script>';
        }
   }

   public function addCom(){
        if(isset($_POST['comenteaza'])){
            echo 'e setat';
            if(strlen($_POST['introdu-com'])>0){
                echo 'e si com';
                $com = $_POST['introdu-com'];
                echo $_COOKIE['utilizator'];
                $util = $_COOKIE['utilizator'];
                $numeProd = $_SESSION['produsDeVazut'];
                $loginViz = new viz_login_produs_model();
                $loginViz->addCom($com,$util,$numeProd);
                
           }
        }
   } 

   public function getDetalii(){
       $mar =new cos_cumparaturi_model();
       $numeProdus=$_SESSION['produsDeVazut'].'.jpg';
       $pret= $mar->getDetaliu($numeProdus,'pret')[0]['pret'];
       $anotimp=$mar->getDetaliu($numeProdus,'anotimp')[0]['anotimp'];
       $destinatar=$mar->getDetaliu($numeProdus,'destinatar')[0]['destinatar'];
       $gramaj=$mar->getDetaliu($numeProdus,'gramaj')[0]['gramaj'];
       $mirosPatrunzator=$mar->getDetaliu($numeProdus,'mirosPatrunzator')[0]['mirosPatrunzator'];
       if($mirosPatrunzator=='true'){$mirosPatrunzator='Da';
        }else{$mirosPatrunzator='Nu';}
       $durataMiros=$mar->getDetaliu($numeProdus,'durataMiros')[0]['durataMiros'];
       $ocazie=$mar->getDetaliu($numeProdus,'ocazie')[0]['ocazie'];
       echo'
        <script type="text/JavaScript">
        let img = document.getElementById(\'imagine\');
        img.src="../imagini-produse/'.$numeProdus.'"
        let nume = document.getElementById(\'nume\');
        nume.innerHTML=\'nume: \'+\''.$_SESSION['produsDeVazut'].'\'
        let pret = document.getElementById(\'pret\');
        pret.innerHTML=\'pret: \'+\''.$pret.'\'+\' lei\'
        let gramaj = document.getElementById(\'gramaj\');
        gramaj.innerHTML=\'cantitate: \'+\''.$gramaj.'\'+\' ml\'
        let anotimp=document.getElementById(\'anotimp\')
        anotimp.innerHTML=\'anotimp: \'+\''.$anotimp.'\'
        let patrunzator=document.getElementById(\'patrunzator\')
        patrunzator.innerHTML=\'miros patrunzator: \'+\''.$mirosPatrunzator.'\'
        let durata=document.getElementById(\'durata\')
        durata.innerHTML=\'durata: \'+\''.$durataMiros.'\'+\' ore\'
        let gen=document.getElementById(\'gen\')
        gen.innerHTML=\'destinat: \'+\''.$destinatar.'\'
        let ocazie=document.getElementById(\'ocazie\')
        ocazie.innerHTML=\'ocazie: \'+\''.$ocazie.'\'

        </script>';

   } 
   
   function getIngrediente(){
       $numeProd = $_SESSION['produsDeVazut'];
       $ing= new viz_login_produs_model();
       $arra=$ing->getIngred($numeProd);
       foreach($arra as $key=>$value){
        // $key ...pozitia in array
        //echo $value['numeIngredient'];
        echo'
        <script type="text/JavaScript">
        let ul'.strval($key).' = document.getElementById(\'ingred\');
        let li'.strval($key).' = document.createElement("li");
        li'.strval($key).'.innerHTML=\'ing: \'+\''.$value['numeIngredient'].'\'
        ul'.strval($key).'.appendChild(li'.strval($key).');
        </script>';
       }
   }
   
   function adaugaInCos(){
    if(isset($_POST['adaugare-cos-vizualizare'])){
        $numerar = intval($_POST['quantity']);
        $numeImg = $_SESSION['produsDeVazut'];
        $cos = json_decode($_COOKIE['produseCos'], true);
        for($i=1;$i<=$numerar;$i++){
            //cosul de cumparaturi este in cookie si inseram produsul actual din session
            //de n ori (adaugam la cookie)
            array_push($cos,$numeImg.'.jpg');
        }
        setcookie('produseCos', json_encode($cos), time() + (86400 * 90), '/');
        //echo $_COOKIE['produseCos'];
    }
   }

   function prodSimilare(){
        if(isset($_POST['login-inrudite'])){
            $numeProd = $_SESSION['produsDeVazut'];
            $ing= new viz_login_produs_model();
            $arra=$ing->getIngred($numeProd);
            $arrayFinal=array();
            foreach($arra as $key=>$value){
                $str=$ing->cautaSimilare($value['numeIngredient']);
                $arr=(explode("/",$str));
                array_pop($arr);
                foreach($arr as $key=>$value){
                    array_push($arrayFinal,$value);
                }
            }
            $arrayFinal=array_unique($arrayFinal);
            $similare=array();
            echo '<p>Produsele similare(click pe imagine)</p>';
            foreach($arrayFinal as $value){
                $sim=$ing->produsDupaId($value);
                if(strcmp($sim,$numeProd.'.jpg')!=0){
                    //print($sim);
                    echo'<script type="text/JavaScript">
                    function detalii(nume){
                        
                        document.write(nume)
                    }
                    </script>';
                    echo '<img id ="similar[]" src="../imagini-produse/'.$sim.'" alt="produs" width="100" height="200" onclick="detalii(\''.$sim.'\')">';
                }
            }
            
        }
    }


}
//!!!!!!!!!!!pt afisare detalii principale fol fcti get detaliu din cos
session_start();
$login=new viz_login_produs();
if(isset( $_GET['username'])){
    $_SESSION['produsDeVazut'] = $_GET['username'];}
$login->adaugaInCos();
$login->afisCom();
//print_r($_COOKIE);
$login->addCom();
$login->getDetalii();
$login->getIngrediente();
$login->prodSimilare();

