<?php
function load_head()
{ ?>
    <head>
        <meta charset="UTF-8">
        <title>Scimba datele personale</title>
        <link href="../css/setari.css" rel="stylesheet">
    </head>
<?php } ?>

<?php
function load_main()
{ ?>
    <main>
        <form action="#" method="POST">
            <div class="schimba_parola">
                <h2>Introdu usename parola actuala si noua parola</h2>
                <input type="text" placeholder="Username" id="uname1" name="uname1" value="">
                <input type="password" placeholder="Parola actuala" id="parola_actuala" name="parola_actuala" value="">
                <input type="password" placeholder="Parola noua" id="parola_noua" name="parola_noua" value="">
                <input type="submit" id="modpar" name = "modpar" value="Moifica parola">
            </div>
    
            <div class="schimba_adresa-email">
                <h2>Introdu username parola actuala pentru a avea acces</h2>
                <input type="text" placeholder="Username" id="uname2" name="uname2" value="">
                <input type="password" placeholder="Parola actuala" id="parola" name="parola" value="">
                <input type="text" placeholder="Noua adresa email" id="email_nou" name="email_nou" value="">
                <input type="submit" id="modemail" name = "modemail" value="Moifica email">
            </div>
        </form>
    </main>
<?php } ?>