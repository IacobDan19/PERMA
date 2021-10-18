<?php
//luam path.ul cum ar fi din controler....
require_once "../app/core/Model.php";
//require database
require_once "../app/core/database.php";
class admin_schimba_produs_model extends Model {
 
    function verifName($numeProdusDeModificat){
        $sql = "SELECT numeProdus FROM produse where numeProdus = :numeProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeProdus' =>$numeProdusDeModificat
        ]);
        return $cerere->fetchAll();//in caz ca nu exi, e un array null
    }

    function updateImage($numeActualProdus,$pathNouImg){
        //update nume si pathname
        $sql = "UPDATE produse SET  pathName = :pathName where numeProdus = :numeProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'pathName' =>$pathNouImg,
            'numeProdus' =>$numeActualProdus
        ]);
        $index=strripos($pathNouImg,'.');//strripos deoarece puncte mai pot exista
        $numeNouProdus=substr($pathNouImg, 0, $index); 
        $sql = "UPDATE produse SET  numeProdus = :numeProdus where pathName = :pathName";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'pathName' =>$pathNouImg,
            'numeProdus' =>$numeNouProdus
        ]);

    }

    function updateIngrediente($ingredient,$idprodus){
        $sql = "SELECT idsProduse FROM ingrediente where numeIngredient= :numeIngredient";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeIngredient' =>$ingredient
        ]);
        $rez=$cerere->fetchAll();
        $count=count($rez);
        if($count>0){
                if (str_contains($rez[0]['idsProduse'],$idprodus.'/')){
                    echo '<p id=\'deja\'>Acest produs contine deja '.$ingredient.' </p>';
                ?>
                <style>
                #deja {
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
                    $sql = "UPDATE ingrediente SET  idsProduse = :idsProduse where numeIngredient = :numeIngredient";
                    $cerere = BD::obtine_conexiune()->prepare($sql);
                    $cerere -> execute([
                        'idsProduse' =>$rez[0]['idsProduse'].$idprodus.'/',
                        'numeIngredient' =>$ingredient
                    ]);
                    echo '<p id=\'ingexistent\'>Ingredientul -<strong>'. $ingredient.'
                    </strong> - exista si am facut update</p>';
                    ?>
                    <style>
                    #ingexistent {
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
        }else{
            //ingredientul este nou update
            $sql = "INSERT INTO ingrediente(numeIngredient,idsProduse) VALUES(:numeIngredient,:idsProduse)";
            $cerere = BD::obtine_conexiune()->prepare($sql);
            $cerere -> execute([
                'numeIngredient'=>$ingredient,
                'idsProduse'=>$idprodus.'/'
            ]);
            echo '<p id=\'ingnou\'>Ingredientul -<strong>'. $ingredient.'
            </strong> - este nou si a fost asignat produsului cu id: '.$idprodus.'</p>';
            ?>
            <style>
            #ingnou {
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

    function stergeIngredient($ingredient,$idprodus){
        $sql = "SELECT idsProduse FROM ingrediente where numeIngredient= :numeIngredient";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'numeIngredient' =>$ingredient
        ]);
        $rez=$cerere->fetchAll();
        $count=count($rez);
        if($count>0){
                if (str_contains($rez[0]['idsProduse'],$idprodus.'/')){
                    $index=strripos($rez[0]['idsProduse'],$idprodus.'/');//strripos deoarece puncte mai pot exista
                    //substr nu da erori in caz de indexul e prea mare e ok la concat
                    $ids=substr($rez[0]['idsProduse'],0,$index).substr($rez[0]['idsProduse'],$index+2,strlen($rez[0]['idsProduse']));
                    $sql = "UPDATE ingrediente SET  idsProduse = :idsProduse where numeIngredient = :numeIngredient";
                    $cerere = BD::obtine_conexiune()->prepare($sql);
                    $cerere -> execute([
                        'idsProduse' =>$ids,//sterg din string id ul
                        'numeIngredient' =>$ingredient
                    ]);
                    
                    echo '<p id=\'dejaSters\'>Acest produs a continut '.$ingredient.' Ingredientul a fost sters. </p>';
                ?>
                <style>
                #dejaSters {
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
                    echo '<p id=\'ingexistentSters\'>Ingredientul -<strong>'. $ingredient.'
                    </strong> - nu a fost componenta acestui parfum</p>';
                    ?>
                    <style>
                    #ingexistentSters {
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
        }else{
            echo '<p id=\'ingnouSters\'>Ingredientul -<strong>'. $ingredient.'
            </strong> - Nu exista inca</p>';
            ?>
            <style>
            #ingnouSters {
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

    function updateItem($item,$valoareNoua,$idProd){
        $sql = "UPDATE produse SET  $item = :itemnou where idProdus = :idProdus";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute([
            'itemnou' =>$valoareNoua,
            'idProdus' => $idProd
        ]);
    }


}