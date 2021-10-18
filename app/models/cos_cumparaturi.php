<?php
//luam path.ul cum ar fi din controler....
require_once "../app/core/Model.php";
require_once "../app/core/database.php";
//require database
class cos_cumparaturi_model extends Model {
    //get nume produs nu are rost ->se ia din arrayul cu nume produse din cookie pt cos
    //pe baza acestui nume selectam in functiile get ce dorim sa afisam in cos, la detalii(tot)
    //$nume produs= in controllerul cos_cumparaturi o sa fie pe rand toate numele din array cookie
    
    public function getDetaliu($numeProdus,$detaliu){
        $sql = "SELECT $detaliu FROM produse where pathName = :pathName ";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'pathName' =>$numeProdus
        ]);
        return $cerere->fetchAll();

    }

    public function addVanzari($arr,$nume){
        //add in vanzari tot din arrayul primit(cookie)
        foreach ($arr as $value) {
            $num =  substr($value, 0, strpos($value, '.'));
            //echo $num;
            $sql = "SELECT numar FROM instoc where numeProdus = :numeProdus";
            $cerere = BD::obtine_conexiune()->prepare($sql);
            $cerere -> execute([
                'numeProdus' =>$num
            ]);
            $numere = $cerere->fetchAll();
            $mai_sunt = $numere[0]['numar'];
            if($mai_sunt>0){
                //daca da, vand si golesc cookie in controller
                $sql = "INSERT INTO vanzari(numeProdus,dataVanzare,numeUtilizator) VALUES(:numeProdus,:dataVanzare,:numeUtilizator)";
                $cerere = BD::obtine_conexiune()->prepare($sql);
                $cerere -> execute([
                    'numeProdus' =>$value,
                    'dataVanzare' =>date("d").'/'.date("m").'/'.date("Y"),
                    'numeUtilizator' =>$nume
                ]);

                //update numar produse
                $sql = "UPDATE instoc SET  numar = :numar where numeProdus = :numeProdus";
                $cerere = BD::obtine_conexiune()->prepare($sql);
                $cerere -> execute([
                    'numar' =>$mai_sunt-1,
                    'numeProdus' =>$num
                ]);

            } else {
                echo '<p id="lipsa">Nu mai avem '.$num.'</p>';
                ?>
                <style>
                #lipsa {
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

    public function addCadou($arr,$util,$tara,$judet,$localitate,$strada,$bloc,$etaj,$nrStrada){
        foreach ($arr as $value) {
            $num =  substr($value, 0, strpos($value, '.'));
            //echo $num;
            $sql = "SELECT numar FROM instoc where numeProdus = :numeProdus";
            $cerere = BD::obtine_conexiune()->prepare($sql);
            $cerere -> execute([
                'numeProdus' =>$num
            ]);
            $numere = $cerere->fetchAll();
            $mai_sunt = $numere[0]['numar'];
            if($mai_sunt>0){
                //daca da, vand si golesc cookie in controller
                $sql = "INSERT INTO cadouri(numeUtilizator,tara,judet,localitate,strada,
                bloc,etaj,nrStrada,dataCadou,numeProdus) VALUES(:numeUtilizator,:tara,:judet,:localitate,
                :strada,:bloc,:etaj,:nrStrada,:dataCadou,:numeProdus)";
                $cerere = BD::obtine_conexiune()->prepare($sql);
                $cerere -> execute([
                    'numeUtilizator'=>$util,
                    'tara'=>$tara,
                    'judet'=>$judet,
                    'localitate'=>$localitate,
                    'strada'=>$strada,
                    'bloc'=>$bloc,
                    'etaj'=>$etaj,
                    'nrStrada'=>$nrStrada,
                    'dataCadou'=>date("d").'/'.date("m").'/'.date("Y"),
                    'numeProdus'=>$num
                ]);
                //update numar produse
                $sql = "UPDATE instoc SET  numar = :numar where numeProdus = :numeProdus";
                $cerere = BD::obtine_conexiune()->prepare($sql);
                $cerere -> execute([
                    'numar' =>$mai_sunt-1,
                    'numeProdus' =>$num
                ]);

                } else {
                    echo '<p id="lipsa">Nu mai avem '.$num.'</p>';
                    ?>
                    <style>
                    #lipsa {
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

}
?>