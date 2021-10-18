<?php  
require_once "../app/models/cos_cumparaturi.php";
require_once "../app/views/cos_cumparaturi/cos_cumparaturi_layout.php";
class cos_cumparaturi extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('cos_cumparaturi');
        $user->name = $name;
        $this->view('cos_cumparaturi/cos_cumparaturi_layout', ['name' => $user->name]);
    }
    
    public function verificaCookie(){
        if(isset($_COOKIE['produseCos'])) {//echo $_COOKIE['produseCos'];
            $data = json_decode($_COOKIE['produseCos'], true);
            //echo gettype($numarPagini);
        
            //forul de mai jos trb pus in functia de onclick buton cu for de la pana la 
            if($data!=[]){
                $mar = new cos_cumparaturi_model();
                $nr=count($data);
                for($i=0;$i<=8;$i++){
                    if(count($data)>$i){
                    $ind=strripos($data[$i],'.');//strripos deoarece puncte mai pot exista
                    $numeNou=substr($data[$i], 0, $ind);     
                    $path ='../imagini-produse/'.$data[$i];
                    $pret= $mar->getDetaliu($data[$i],'pret')[0]['pret'];
                    $anotimp=$mar->getDetaliu($data[$i],'anotimp')[0]['anotimp'];
                    $destinatar=$mar->getDetaliu($data[$i],'destinatar')[0]['destinatar'];
                    $gramaj=$mar->getDetaliu($data[$i],'gramaj')[0]['gramaj'];
                    $mirosPatrunzator=$mar->getDetaliu($data[$i],'mirosPatrunzator')[0]['mirosPatrunzator'];
                    $durataMiros=$mar->getDetaliu($data[$i],'durataMiros')[0]['durataMiros'];
                    $ocazie=$mar->getDetaliu($data[$i],'ocazie')[0]['ocazie'];
                    echo '<script type="text/JavaScript">
                    addProdus(\''.'poza'.strval($i+1).'\',\''.$path.'\',\''.$numeNou.'\',\''.$pret.'\',\''.$gramaj.'\',\''.$mirosPatrunzator.'\',\''.$durataMiros.'\',\''.$destinatar.'\',
                    \''.$ocazie.'\',\''.$anotimp.'\');
                    </script>';}}
            
                $numarPagini = intval($nr/9);
                if ($nr%9 !=0){$numarPagini++;}
                
                $contor_pe_pagina = 0;
                for($i=1;$i<=$numarPagini;$i++){
                    echo '<script type="text/JavaScript">
            
                        addButonPaginare(\''.$i.'\');
                        function addButonPaginare(nume){
                            let paginare = document.getElementById(\'paginare\'); 
                            let button = document.createElement(\'button\');
                            button.id= \'btn\'+nume;
                            button.name= \'btn\'+nume;
                            button.innerHTML = \'<\'+nume+\'>\';
                            button.type=\'button\';
                            
                            paginare.appendChild(button);
                            let btn = document.getElementById(\'paginare\');
                            var r1 = btn.closest(\'#\'+\'btn\'+nume);
            
                            //adaugam Listener() pt buton
                            let butt = document.getElementById(\'btn\'+nume);
                            const arry = '.json_encode($data).';
                            //document.write(\'***\'+arry);
                            butt.addEventListener(\'click\', 
                            ()=>afiseazaImaginile(parseInt(nume),arry));
                        }
                        
                        
                    </script>';
                    
                    for($j=$contor_pe_pagina;$j<=$contor_pe_pagina+8;$j++){}
                    $contor_pe_pagina=$contor_pe_pagina+9;
                    //aici apelez fctia din js pastrand numele poza1,2,3...9 dar schimband numele in path 
                }
                echo '<script type="text/JavaScript">
                    let search = document.getElementById(\'paginare\');
                    search.style.backgroundColor=\'red\';
                    search.style.display =\'flex\';
                    search.style.justifyContent=\'center\';
                    search.style.margin = \'50px 10px 20px 20rem\';
                    let p = document.createElement(\'p\');
                    p.innerHTML =\'paginare\';
                    search.insertBefore(p, search.childNodes[-1]);
                    </script>';
            }
        }
    }

    public function trimiteComandaProprie(){
        if(isset($_POST['cumpara-pt-tine'])){
            $mar = new cos_cumparaturi_model();
            $produse_de_adaugat = json_decode($_COOKIE['produseCos'], true);
            $numeUtil=$_COOKIE['utilizator'];
            $mar->addVanzari($produse_de_adaugat, $numeUtil);
            //golim cosul
            setcookie('produseCos', json_encode([]), time() + (86400 * 90), '/');
        }
    }

    public function trimiteCadou(){
        if(isset($_POST['ofera-cadou'])){
            $tara = $_POST['ctara'];
            $judet= $_POST['cjudet'];
            $localitate= $_POST['clocalitate'];
            $strada=$_POST['cstrada'];
            $bloc=$_POST['cbloc'];
            $etaj=$_POST['cetaj'];
            $nrStrada=$_POST['cnrstr'];   
            if( intval(strlen($tara))*intval(strlen($judet))*intval(strlen($localitate))*
            intval(strlen($strada))*intval(strlen($bloc))*
            intval(strlen($etaj))*intval(strlen($nrStrada)) ==0){
                echo '<p id="gol">Asigura-te ca ai completat toate campurile</p>';
                ?>
                <style>
                #gol {
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
                //inregisrare comanda
                $util=$_COOKIE['utilizator'];
                $produse_de_adaugat = json_decode($_COOKIE['produseCos'], true);
                $mar = new cos_cumparaturi_model();
                $mar->addCadou($produse_de_adaugat,$util,$tara,$judet,$localitate,
                    $strada,$bloc,$etaj,$nrStrada);
                //golim cosul
                //setcookie('produseCos', json_encode([]), time() + (86400 * 90), '/');    
            }
         }
    }
    
}

session_start();
$_SESSION['produsDeVazut']='parfum-lavanda';
//setcookie('produseCos', json_encode([]), time() + (86400 * 90), '/');
//$ary=array("parfum-lavanda.jpg", "parfum-pentru-barbati1.jpg", "parfum-pentru-barbati5.jpg");
//setcookie("produseCos", json_encode($ary), time() + (86400 * 90), "/");//deja exista
//$data = json_decode($_COOKIE['produseCos'], true);
//print_r( count($data));
//array_splice($data, 3);
 //array_push($data,"parfum-lavanda.jpg","parfum-pentru-barbati1.jpg","parfum-pentru-barbati5.jpg","parfum-pentru-barbati3.jpg","parfum-pentru-femei1.jpg","parfum-pentru-femei2.jpg",
//"parfum-pentru-femei3.jpg","parfum-pentru-femei4.jpg","parfum-pentru-femei5.jpg","parfum-pentru-barbati2.jpg");
//$_COOKIE['produseCos'] = json_encode($data);
//You can update a cookie value using setcookie() function, but you should add '/' in the 4th 
//argument which is the 'path' argument, to prevent creating another cookie with the same name.
//setcookie('produseCos', json_encode($data), time() + (86400 * 90), '/');

//$path = "/" and put it as setcookie argument, for tell to browser :
// "send the cookie at every script in the domain or subdomain"

/*setcookie('utilizator', 'dan77', time() + (86400 * 90), '/');
setcookie('tara', 'Romania', time() + (86400 * 90), '/');
setcookie('localitatea', 'Iasi', time() + (86400 * 90), '/');
setcookie('strada', 'strada1', time() + (86400 * 90), '/');
setcookie('judet', 'iasi', time() + (86400 * 90), '/');
setcookie('bloc', '1', time() + (86400 * 90), '/');*/

//incearca incarcare script aici
$mar = new cos_cumparaturi_model();
echo'
<script>
    function scoateDinCos(numePoza){
        let scos = document.getElementById(numePoza);
        scos.style.display = \'none\'
        
    }
    //adaugaImg();

    function addProdus(className,src,nume,pret,gramaj,patrunzator,durata,gen,ocaz,anot){
       let element =document.getElementById(\'poze-cumparaturi\');
        let produsNou = document.createElement(\'div\');
        produsNou.className = className;
        produsNou.id=className;
        //***
        let a = document.createElement(\'a\');
        a.href =\'../viz_login_produs/index?\'+\'username=\'+nume;
        //***
        let img = document.createElement(\'img\');
        img.id=nume;
        img.src = src;
        img.alt =\'Imagine produs\';
        
        produsNou.appendChild(a); 
        a.appendChild(img);
        
        let div = document.createElement(\'div\');
        let ul = document.createElement(\'ul\');

        let liNume = document.createElement(\'li\');
        liNume.innerHTML =\'Nume: \'+nume;
        let liPret = document.createElement(\'li\');
        liPret.innerHTML =\'Pret: \'+pret+\' Lei\';
        let liGramaj = document.createElement(\'li\');
        liGramaj.innerHTML =\'Gramaj: \'+gramaj+\' ml\';
        let liPatr = document.createElement(\'li\');
        liPatr.innerHTML =\'Miros patrunzator: \'+ patrunzator;
        let liDurata = document.createElement(\'li\');
        liDurata.innerHTML =\'Durata miros: \'+durata+\' ore\';
        let liGen = document.createElement(\'li\');
        liGen.innerHTML =\'Destinat: \'+gen;
        let liocazie = document.createElement(\'li\');
        liocazie.innerHTML =\'Ocazii:</br> \'+ocaz;
        let lianot = document.createElement(\'li\');
        lianot.innerHTML =\'Anotimp: \'+anot;
        ul.appendChild(liNume); 
        ul.appendChild(liPret); 
        ul.appendChild(liGramaj);
        ul.appendChild(liPatr);
        ul.appendChild(liDurata);
        ul.appendChild(liGen);
        ul.appendChild(liocazie);
        ul.appendChild(lianot);

        let button = document.createElement(\'button\');
        button.type =\'submit\';
        button.name = \'c1\';
        button.innerHTML=\'Scoate din cos\';
        button.id= \'scoate\'+className

        let input = document.createElement(\'div\');
        div.appendChild(ul); 
        div.appendChild(button); 

        produsNou.appendChild(div); 
        element.appendChild(produsNou);
        //****
        let sc = document.getElementById(\'scoate\'+className)
        sc.addEventListener(\'click\', ()=>scoateDinCos(className))

    }

    function afiseazaImaginile(numar,data){
        //data e primita ca un string si transform in array
        ar=[];
        for(i=0;i<data.length;i++){
            ar.push(data[i]);
        }
        var c = document.getElementById("poze-cumparaturi").childElementCount;
        //document.write(c);
        for(i=1;i<c;i++){
            let upp = document.getElementById("poze-cumparaturi");
            upp.removeChild(upp.lastChild);
        }

        index = (numar-1)*9;
        contor=1;
        for(im=index;im<=index+8;im++){
            if (ar.length >im){
                produs = ar[im];
                path = \'../imagini-produse/\'+produs;
                pozitie = produs.indexOf(".");
                nume = produs.slice(0, pozitie);    
                pret = '.$mar->getDetaliu('parfum-pentru-barbati5.jpg','pret')[0]['pret'].
                '
                addProdus(\'poza\'+contor.toString(),path,nume,pret,\'100\',\'true\',\'4\',\'f\',\'botez\',\'vara\');
                contor++;
            }
        }
    }
</script>';




$cos = new cos_cumparaturi();
$cos->verificaCookie();
$cos->trimiteComandaProprie();
$cos->trimiteCadou();
//print_r($_COOKIE);

echo $_COOKIE['produseCos'];
?>
