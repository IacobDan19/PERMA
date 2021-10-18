<?php
function load_head()
{ ?>
     <head>
        <meta charset="UTF-8">
        <title>Vizualizare produs</title>
        <link href="../css/vizualizare-login-produs.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
    </head>
    <!--sa fac functii in model-ul acestei pagini pt get pret get nume get etc...-->
    <!--Sa nu uit numele de clase incep cu majuscula-->
<?php } ?>

<?php
function load_header()
{ ?>
    <header>
        <!--nav al lui Stativa Vlad-->
        <nav>
            <ul class = "navbar">
                <li>
                <a href="../setari_de_cont/index">Setări cont</a>
                </li>
                <li>
                <a href = "#"><s>Delogare</s></a>
                </li>
            </ul>
        </nav>
    </header>
<?php } ?>


<?php
function load_main()
{ ?>
    <main>
        <form  action="#" method="POST">
            <div class="produs">
                
                <img id="imagine" alt="pafum-lavanda" >
                <div class="detalii-generale">
                    <div class="detalii-produs">
                        <ul>
                            <!--este ok sa apelez functiile get din model aici(in view?)-->
                            <li id="nume">Nume produs</li>
                            <li id = "pret">Pret produs</li>
                            <li id="gramaj">Gramaj</li>
                            <li id="patrunzator">Proprietate miros(patrunzator)</li>
                            <li id="durata">Proprietate miros(durata)</li>
                            <li id="gen">Destinat(genul)</li>
                            <li id ="ocazie">Ocazie(adecvat unui/unei)</li>
                            <li id="anotimp">Anotimpul in care este recomandat</li>
                        </ul>
                    </div> 

                    <div class="ingrediente">
                        <h3>Acest parfum contine: </h3>
                        <ul id="ingred">
                            
                        </ul>
                        <input type="submit" name="login-inrudite" value="Vezi produsele inrudite">
                    </div>
                </div>
                

                <div class="adauga-cos">
                    <h3>Adauga acest produs in cosul tau de cumparaturi</h3>
                    <label for="quantity">Alege numarul dorit pentru acest produs</label>
                    <input type="number" name ="quantity" id="quantity" value ="1" min="1">

                    <button type="submit" name ="adaugare-cos-vizualizare"
                    id="adaugare-cos-vizualizare">Adauga in cos</button>


                </div>
            </div>

            <div  class="chat" id="chat" >
                <!--functie de stergere comentariu(doar propriul com)-->
                <label for="introdu-com">Adauga comentariu</label>
                <textarea id="introdu-com" name="introdu-com" maxlength="150"  rows="4" cols="100">
                </textarea>
                <br><br>
                <input type="submit" value="Comenteaza" name="comenteaza">
            </div>
        </form>
    </main>

<?php } ?>