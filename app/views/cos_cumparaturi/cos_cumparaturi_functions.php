<?php

function load_head()
{ ?>
    <head>
        <meta charset="UTF-8">
        <title>Cumparaturi</title>
        <link href="../css/cumparaturii1.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
    </head>
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
            <h1>Acesta este cosul tau de cumparaturi</h1>
            <div class="poze-cumparaturi" id="poze-cumparaturi">

                <div class="paginare" id="paginare">

                </div> 
            </div>
            
            <div class="cumpara-pentru-tine">
                <h3>Cumpara pentru tine(la adresa furnizata)</h3>
                <input type="submit" name = "cumpara-pt-tine" value="Trimite comanda">
            </div>

            <div class="cumpara-regim-cadou">
                <h3>Completeaza adresa de mai jos si trimite produsele din cos in regim de cadou </h3>
                <div class ="cadou">
                    <div class="adresa">
                        <input type="text" placeholder="Tara" id="ctara" name="ctara" value="">
                        <input type="text" placeholder="Judet" id="cjudet" name="cjudet" value="">
                        <input type="text" placeholder="Localitate" id="clocalitate" name="clocalitate" value="">
                        <input type="text" placeholder="Strada" id="cstrada" name="cstrada" value="">
                        <input type="text" placeholder="Bloc" id="cbloc" name="cbloc" value="">
                        <input type="text" placeholder="Etaj" id="cetaj" name="cetaj" value="">
                        <input type="text" placeholder="Nr. strada" id="cnrstr" name="cnrstr" value="">
                        <input type="submit" name = "ofera-cadou" value="Trimite codoul">
                    </div>
                </div>
            </div>
        </form>    
    </main>
<?php } ?>