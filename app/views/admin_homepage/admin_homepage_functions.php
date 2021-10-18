<?php
function load_head()
{ ?>
    <head>
        <meta charset="UTF-8">
        <title>Admin-homepage</title>
        <link href="../css/admin-homepage.css" rel="stylesheet">
    </head>
<?php } ?>

<?php
function load_main()
{ ?>
    <main>
        <div class = "alegeri-admin">
            <h1>Alege dintre urmatoarele functii disponibile administrator</h1>
            <ul >
                <li>
                    <a href = "../admin_schimba_produs/index">Schimba un produs</a>
                </li>
                <li>
                <a href="../admin_statistici/index">Vezi statisticile</a>
                </li>
                <li>
                    <a href = "./html/index_delog.html">Delogare</a>
                </li>
            </ul>
            </div>
    </main>
<?php } ?>