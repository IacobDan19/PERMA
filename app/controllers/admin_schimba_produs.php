<?php  
session_start();
require_once "../app/models/viz_login_produs.php";
require_once "../app/models/admin_schimba_produs.php";
require_once "../app/models/cos_cumparaturi.php";
require_once "../app/views/admin_schimba_produs/admin_schimba_produs_layout.php";
class admin_schimba_produs extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('admin_schimba_produs');
        $user->name = $name;
        $this->view('admin_schimba_produs/admin_schimba_produs_layout', ['name' => $user->name]);
    }

    public function hideUpdate(){
        echo '<script type="text/JavaScript">
        let up = document.getElementById(\'update\');
        up.style.display = \'none\'
        </script>';
        if(isset($_POST['vreau'])){
            $numeDeModif = $_POST['pnumeactual'];
            $veri=new admin_schimba_produs_model();
            $rez=$veri->verifName($numeDeModif);
            if(count($rez)>0){ 
                $_SESSION['produsDeModificat']=$numeDeModif;
                $mar = new cos_cumparaturi_model();
                $id=$mar->getDetaliu($numeDeModif.'.jpg','idProdus')[0]['idProdus'];
                $_SESSION['idProd']=$id;
                echo '<script type="text/JavaScript">
                let se = document.getElementById(\'update\');
                se.style.display = \'flex\'
                </script>';
            }else{
                echo '<p id="prod-neex">Acest produs nu exista. Insereaza unul valid</p>';
                ?>
                <style>
                #prod-neex {
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
            }
            
        }
    }

    public function schimbaImaginea(){
        if(isset($_SESSION['produsDeModificat'])){//chiar daca fiind none sigur e
            if(isset($_POST['upimg'])){
                $target_dir = "../imagini-produse/";
                $target_file = $target_dir . basename($_FILES["gallery-img"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if(isset($_POST["upimg"])) {
                $check = getimagesize($_FILES["gallery-img"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["gallery-img"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                 ) {
                echo "Sorry, only JPG, PNG  files are allowed.";
                $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                if (move_uploaded_file($_FILES["gallery-img"]["tmp_name"], $target_file)) {
                    
                    //aici fac update abia in baza de date
                    $chImg=new admin_schimba_produs_model();
                    $numeImg=htmlspecialchars( basename( $_FILES["gallery-img"]["name"]));
                    $chImg->updateImage($_SESSION['produsDeModificat'],$numeImg);

                    //schimba si in cookie cos cumparaturi
                    $data = json_decode($_COOKIE['produseCos'], true);
                    $ind=strripos($numeImg,'.');//strripos deoarece puncte mai pot exista
                    $numeNou=substr($numeImg, 0, $ind); 
                    $data = str_replace($_SESSION['produsDeModificat'], $numeNou,$data);
                    //update datele in cookie(imaginea produs)
                    //setcookie('produseCos', json_encode($data), time() + (86400 * 90), '/');
                    
                    //!!! fiind afisat, prin apasare buton upload
                    //!!! numele fisierului ales, protocolul http nu permite 
                    //!!!modificarea header cu informati
                    //!!!am ales totusi ca produs initial sa coexiste cu cel nou(variante)
                    echo "The file ". htmlspecialchars( basename( $_FILES["gallery-img"]["name"])). " has been uploaded.";

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                }
                            }
                        }
    }

    function afisIngrediente(){
        if(isset($_SESSION['produsDeModificat']) && isset($_POST['vreau'])){
            $numeProd = $_SESSION['produsDeModificat'];
            $ing= new viz_login_produs_model();
            $arra=$ing->getIngred($numeProd);
            echo'
             <script type="text/JavaScript">
             let ul = document.getElementById(\'ingrediente\');
             </script>';
            foreach($arra as $key=>$value){
             // $key ...pozitia in array
             //echo $value['numeIngredient'];
             echo'
             <script type="text/JavaScript">
             let li'.strval($key).' = document.createElement("li");
             li'.strval($key).'.innerHTML=\'ing: \'+\''.$value['numeIngredient'].'\'
             ul.appendChild(li'.strval($key).');
             </script>';
            }
        }
    }

    function aplicaModificari(){
        if(isset($_POST['schimba-produs'])){
            if(strlen($_POST['adauga-ingredient'])>0){
                //echo $_SESSION['idProd'];
                $ing= new admin_schimba_produs_model();
                $ingredient=$_POST['adauga-ingredient'];
                $idprodus=$_SESSION['idProd'];
                $ing->updateIngrediente($ingredient,$idprodus);
            }

            if(strlen($_POST['sterge-ingredient'])>0){
                $ing= new admin_schimba_produs_model();
                $ingredient=$_POST['sterge-ingredient'];
                $idprodus=$_SESSION['idProd'];
                $ing->stergeIngredient($ingredient,$idprodus);
            }

            if(strlen($_POST['pnume'])>0){
                $idProd=$_SESSION['idProd'];
                $item='numeProdus';
                $target_dir = "../imagini-produse/";
                $target_file = $target_dir . basename($_SESSION['produsDeModificat'].'.jpg');
                $valoareNoua=$_POST['pnume'];
                $Newtarget_file = $target_dir . basename($valoareNoua.'.jpg');
                if(file_exists($Newtarget_file)) {
                    echo "Acest nume exista deja";
                }else{
                    //putem modifica numele fisierului in folder
                    rename($target_file,$Newtarget_file);
                }

                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);//numele
                $ing->updateItem('pathName',$_POST['pnume'].'.jpg',$idProd);//pathname-ul
            }
            $idProd=$_SESSION['idProd'];
            if(strlen($_POST['ppret'])>0){
                $item='pret';
                $valoareNoua=$_POST['ppret'];
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['pgramaj'])>0){
                $item='gramaj';
                $valoareNoua=$_POST['pgramaj'];
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['ppatrunzator'])!='null'){
                $item='mirosPatrunzator';
                $valoareNoua=$_POST['ppatrunzator'];
                if($valoareNoua=='persistent'){$valoareNoua='true';
                }else{$valoareNoua='false';}
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['pdurata'])>0){
                $item='durataMiros';
                $valoareNoua=$_POST['pdurata'];
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['pgen'])!='null'){
                $item='destinatar';
                $valoareNoua=substr($_POST['pgen'],0,1);
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['pocazie'])>0){
                $item='ocazie';
                $valoareNoua=$_POST['pocazie'];
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }

            if(strlen($_POST['panotimp'])!='null'){
                $item='anotimp';
                $valoareNoua=$_POST['panotimp'];
                $ing= new admin_schimba_produs_model();
                $ing->updateItem($item,$valoareNoua,$idProd);
            }
        }
    }


}
$updateAdmin = new admin_schimba_produs();
$updateAdmin->schimbaImaginea();
$updateAdmin->hideUpdate();
$updateAdmin->afisIngrediente();
$updateAdmin->aplicaModificari();
