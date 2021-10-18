<?php
function load_head()
{ ?>
    <head>
        <meta charset="UTF-8">
        <title>Scimba datele produs</title>
        <link href="../css/admin-schimba-produs1.css" rel="stylesheet">
    </head>
<?php } ?>

<?php
function load_main()
{ ?>
    <main>
        <a href="../admin_homepage/index">Inapoi la meniu</a>
        <h1>Introdu numele produsului de modificat(numele e unic)</h1>
        <form  action="#" method="POST" enctype="multipart/form-data">
            <div class="schimbare">
                <label for="pnumeactual">*Introdu numele produsului ce trebuie modificat
                </label>
                <input type="text" id="pnumeactual" name="pnumeactual">
                <button type="submit" id="vreau" name="vreau">Vreau sa modific acest produs</button>
            <div class="update" id="update" >    
                <div class="schimba-imaginea">
                    <p>Nu poti selecta mai mult de o imagine de tip png sau jpg </p>
                    <ul>
                        <!--in input nu trebuie sa fie multiple ca parametru-->
                        <li>
                            <label for="gallery-img">Alege imaginea noua a produsului(aceasta actiune modifica automat si numele)
                            </label></br>
                            <input type="file"
                                id="gallery-img"  name="gallery-img"
                                accept="image/png, image/jpeg">
                        </li>
                    </ul>
                    <input type="submit" value="Upload Image" name="upimg">
                </div>
                <h3>Aplică schimbări</h3>
                <label for="pnume">Introdu noul nume al produsului
                    (!!!acesta trebuie sa fie unic)
                </label>
                <input type="text" id="pnume" name="pnume">

                <label for="ppret">Introdu in LEI (noul) pret</label>
                <input type="number" id="ppret" name="ppret" min="1">

                <label for="pgramaj">Introdu in unitatea (ml) cantitatea de parfum</label>
                <input type="number" id="pgramaj" name="pgramaj" min="1">

                <!--in lucrul cu bd verific daca e diferit de null(option)-->
                <label for="ppatrunzator">Modifica(introdu tipulmirosului)</label>
                <select name="ppatrunzator" id="ppatrunzator">
                    <option value="null">null</option>
                    <option value="persistent">persistent</option>
                    <option value="nonpersistent">nonpersistent</option>
                    
                </select>

                <label for="pdurata">Modifica in ORE(introdu timpul  in care parfumul persista)
                </label>
                <input type="number" id="pdurata" name="pdurata" min="1">

                <!--in lucrul cu bd verific daca e diferit de null(option)-->
                <label for="pgen">Modifia(introdu genul pentru care este destinat)</label>
                <select name="pgen" id="pgen">
                    <option value="null">null</option>
                    <option value="feminin">feminin</option>
                    <option value="masculin">masculin</option>
                    
                </select>

                <!--Aici in codul php transformam in lower inputul pentru ocazie-->
                <label for="pocazie">Modifica (introdu ocazia)</label>
                <input type="text" id="pocazie" name="pocazie">

                <!--in lucrul cu bd verific daca e diferit de null(option)-->
                <label for="panotimp">Alege anotimpul in care produsul sa fie recomandat</label>
                <select name="panotimp" id="panotimp">
                    <option value="null">null</option>
                    <option value="iarna">iarna</option>
                    <option value="primavara">primavara</option>
                    <option value="vara">vara</option>
                    <option value="toamna">toamna</option>
                </select>

            </div>
            </div>
            <div class="mod-ingrediente" id="mod-ingrediente">
                <label for="adauga-ingredient">Adauga un ingredient la acest parfum
                </label>
                <input type="text" id="adauga-ingredient" name="adauga-ingredient">

                <!--Aici o sa fie un select din baza de date si incarcare fol cod dinamic -->
                <div class="ingrediente">
                    <h3>Acest parfum contine: </h3>
                    <ul id="ingrediente">
                    </ul>
                    <label for="sterge-ingredient">Sterge un ingredient al acestui parfum
                    </label>
                    <input type="text" id="sterge-ingredient" name="sterge-ingredient">
                </div>
                <input type="submit" name = "schimba-produs" value="Aplica modificarea" id="schimba-produs">
            </div>
            
        </form>
    </main>   
     
<?php } ?>