<?php  
require_once "../app/models/admin_statistici.php";
require_once "../app/views/admin_statistici/admin_statistici_layout.php";
use Dompdf\Dompdf;
class admin_statistici extends Controller {
    //declaram variabile....aici
    public function index($name = '')
    {
        $user = $this->model('admin_statistici');
        $user->name = $name;
        $this->view('admin_statistici/admin_statistici_layout', ['name' => $user->name]);
    }

    function topdf(){
        if(isset($_POST['sub_op'])){
            require_once '../dompdf/autoload.inc.php';
            //$html = ob_get_clean();
            $dompdf = new Dompdf();
            $dompdf->loadHtml(ob_get_contents());
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            ob_end_clean();
            $dompdf->stream("statistici");
        }
    }

    public function inStoc(){
        $instoc=new admin_statistici_model();
        $rezultat=$instoc->getNrProduse();
        $ind=0;
        foreach($rezultat as $x => $x_value) {
            echo'<script>
            let stoc'.strval($ind).' =document.getElementById(\'stocuri\');
            var para = document.createElement("p");
            para.innerHTML=\'Produsul <strong>'.$x. '</strong> din care mai avem '.$x_value.' produse. \';
            stoc'.strval($ind).'.appendChild(para);
            </script>';
            $ind++;
          }
    }

    public function topDestinatari(){
        $pstoc=new admin_statistici_model();
        $array=$pstoc->getProduseArray();//in mod sigur doua valori 
        //daca nu ar exista produse vandute pt un gen(0) tot avem un produs
        //print_r($array);
        echo'<script>
        let topfemei =document.getElementById(\'femei\');
        let topbarbati =document.getElementById(\'barbati\');
        topfemei.innerHTML=\'Cel mai vandut produs pentru femei: '.$array[0].'\'
        topbarbati.innerHTML=\'Cel mai vandut produs pentru barbati: '.$array[1].'\'
        </script>';
    }
}

$stoc = new admin_statistici();
$stoc->topdf();
$stoc->inStoc();
$stoc->topDestinatari();