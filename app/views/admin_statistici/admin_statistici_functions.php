<?php
function load_head()
{ ?>
    <head>
        <meta charset="UTF-8">
        <title>Statistici-administrator</title>
        <link href="../css/admin-statistici.css" rel="stylesheet">
    </head>
<?php } ?>

<?php
function load_main()
{ ?>
    <main>
        <form action="#" method="POST" enctype="multipart/form-data">
        <a href="../admin_homepage/index">Inapoi la meniu</a>
        <h1>Statistici de interes</h1>

        <div class="stocuri">
            <p id="stocuri">Produsele din stoc sunt in numar de:</p>
        </div>

        <div class="dupa-categorie">
            <p id="femei">Cel mai vandut produs pentru femei:</p>
            <p id="barbati">Cel mai vandut produs pentru barbati:</p>
        </div>

        <div class="dupa-anotimp">
            <ul>
                <li>Cel mai vandut produs destinat (iarna) :</li>
                <li>Cel mai vandut produs destinat (primavara) :</li>
                <li>Cel mai vandut produs destinat (vara) :</li>
                <li>Cel mai vandut produs destinat (toamna) :</li>
            </ul>
        </div>

        <div class="dupa-varsta">
            <ul>
                <li>Cel mai vandut produs in randul tinerilor(pana in 30 ani)este :</li>
                <li>Cel mai vandut produs in randul persoanelor intre 30 si 50 este :</li>
                <li>Cel mai vandut produs in randul persoanelor peste 50 ani :</li>
            </ul>
        </div>

        <div class="alege-format-vizualizare">
            <h3>Consulta rapoartele in formatul:</h3>
            <ul>
                <li>
                <label for="varianta-html">HTML</label>
                <input type="radio" id="varianta-html" name="vizualizare" value="varianta-html" >
                </li>
                <li>
                <label for="varianta-csv">CSV</label>
                <input type="radio" id="varianta-csv" name="vizualizare" value="varianta-csv">
                </li>
                <li>
                <label for="varianta-pdf">PDF</label>
                <input type="radio" id="varianta-pdf" name="vizualizare" value="varianta-pdf"
                checked>
                </li>
            </ul>
            <input type="submit" name="sub_op" value="Vezi">
        </div>
        </form>
    </main>
<?php } ?>