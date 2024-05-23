<!--controllo che la sessione sia partita-->
<?php 
    if (!isset($_SESSION)) {
        //inizializzazione sessione
        session_start();
    }
?>

<html>
    <head>
        <!--titolo della pagina-->
        <title> Pagina admin </title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/accesso.js"></script>

        <!--foglio di stile interno-->
        <link rel="stylesheet" href="../style/style.css">

        <!--gestione delle attività dell'admin-->
        <script>
            //reindirizzamento alla pagina di gestione delle stazioni (visualizza, crea, elimina, modifica)
            function gestioneStazioni(){
                window.location.href="gestioneStazioni.php";
            }

            //reindirizzamento alla pagina di gestione delle bici (visualizza, crea, elimina, modifica)
            function gestioneBici(){
                window.location.href="gestioneBici.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="form">
            <!--titolo interno alla pagina-->
            <h1> Pagina admin </h1>

            <!--bottone per gestire le stazioni-->
            <button class="b" type="button" onclick="gestioneStazioni()"> Gestione stazioni </button>

            <!--bottone per gestire le bici-->
            <button class="b" type="button" onclick="gestioneBici()"> Gestione biciclette </button>

            <!--bottone per effettuare la logout-->
            <button class="b" type="button" onclick="logout()"> Logout </button>
        </div>
    </body>
</html>