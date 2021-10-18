<?php
function load_head()
{ ?>
<head>
        <meta charset="UTF-8">
        <title>Vizualizare produs logout</title>
        <link href="../css/vizualizare-login-produs.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
    </head>


<?php } ?>

<?php
function load_header()
{ ?>
<header>
    <nav>
        <ul class = "navbar">
            
            <li>
                <a href = "./html/index_log.html">Home</a>
            </li>
            <li>
                <a href="./html/register.html">Înregistrare</a>
            </li>
            <li>
                <a href="./html/login.html">Logare</a>
            </li>
            <li>
                <a href = "./html/index_log.html">Home</a>
            </li>
            <li>
                <a href="./setari.html">Setări cont</a>
            </li>
        </ul> 
    </nav>
</header>

<?php } ?>

<?php
function load_main()
{ ?>
<main>
            
    <div class="produs">
        
        <img src="../imagini-produse/parfum-lavanda.jpg" alt="pafum-lavanda" >
        <div class="detalii-generale">
            <div class="detalii-produs">
                <ul>
                    <!--este ok sa apelez functiile get din model aici(in view?)-->
                    <li>Nume produs</li>
                    <li>Pret produs</li>
                    <li>Gramaj</li>
                    <li>Proprietate miros(patrunzator)</li>
                    <li>Proprietate miros(durata)</li>
                    <li>Destinat(genul)</li>
                    <li>Ocazie(adecvat unui/unei)</li>
                    <li>Anotimpul in care este recomandat</li>
                </ul>
            </div> 

            <div class="ingrediente">
                <h3>Acest parfum contine: </h3>
                <ul>
                    <li>Lavanda</li>
                    <li>Lavanda</li>
                    <li>Lavanda</li>
                    <li>Lavanda</li>
                </ul>
                <input type="submit" name="logout-inrudite" value="Vezi produsele inrudite">
            </div>
        </div>
    
    </div>

    <div class="chat">
        <div>
            <ul>
                <li>user1</li>
                <li>Un produs bun</li>
            </ul>
        </div>

        <div>
            <ul>
                <li>user2</li>
                <li>Un produs ok</li>
            </ul>
        </div>

        <div>
            <ul>
                <li>user3</li>
                <li>Un produs rau</li>
            </ul>
        </div>
    </div>

</main>

<?php } ?>
